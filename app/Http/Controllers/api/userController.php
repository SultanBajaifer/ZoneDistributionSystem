<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\DistributionPoint as DistributionPointResource;
use App\Models\DistributionPoint;
use App\Http\Resources\DistributionRecord as DistributionRecordResource;
use App\Models\DistributionRecord;
use App\Models\RecipientsList;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->authorizeResource(User::class, 'user');
        // $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $user = UserResource::collection(User::paginate());
        return $user->response()->setStatusCode(200, "User Returned Succefully")->
            header("Addestionl Header", "true");
    }
    /**
     * Search in the model.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function mySearch(Request $request)
    {
        $searchValue = isset($request->value) ? $request->value : 'name';
        $searchAscOrDesc = $request->ascOrDesc == "desc" ? "DESC" : 'ASC';
        // Select * from users where userName like
        // '%$value%' order by users . userName DESC;
        $result = $this->search(
            'users',
            $searchValue,
            'userName',
            $request->filter,
            $searchAscOrDesc
        );

        // $result = DB::table('users')->where('userName', $request->value)->get()->toJson();
        return response()->json($result, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        // $this->authorize('create', User::class);

        $validator = $this->validate(
            $request,
            [
                'name' => 'required',
                'userName' => 'required',
                'userType' => 'required',
                'password' => 'required',
                'email' => 'required',
                'addressID' => 'required'
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $user = UserResource::make(User::create([
                'name' => $request->name,
                'userName' => $request->userName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'addressID' => $request->addressID,
                'userType' => $request->userType
            ]));
            $i['message'] = "User Created Succefully";
            $i['new value'] = $user;
            $validator->setData($i);
            return $validator;
        }
        return $validator;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {

        $user = UserResource::make(User::findOrFail($id));
        return $user->response()->setStatusCode(200, "User Returned Succefully")->
            header("Addestionl Header", "true");


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update($id, Request $request)
    {
        $validator = $this->validate(
            $request,
            [
                'name' => 'required',
                'userName' => 'required',
                'userType' => 'required',
                'password' => 'required',
                'email' => 'required',
                'addressID' => 'required'
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            // $idUser = User::findOrFail($id);
            // $this->authorize("update", $idUser);
            $user = UserResource::make(User::findorFail($id));
            $user->update([
                'name' => $request->name,
                'userName' => $request->userName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'addressID' => $request->addressID,
                'userType' => $request->userType
            ]);
            $i['message'] = "user Updated Succefully";
            $i['new value'] = $user;
            $validator->setData($i);
            return $validator;
        }
        return $validator;



    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {

        $data = User::findOrFail($id);
        $this->authorize("update", $data);
        $data->delete();
        return Response::json(
            [
                'Deleted User' => $data
            ],
            202
        );

    }
    public function sendRecipientsList($id)
    {
        $RecipientLists = DistributionPoint::findOrFail($id)->recipientsLists;
        $field = array();
        $filtered = array();
        foreach ($RecipientLists as $RecipientList) {
            if ($RecipientList->is_send == 1) {

                $field['id'] = $RecipientList->id;
                $field['name'] = $RecipientList->name;
                $field['creationDate'] = $RecipientList->creationDate;
                $field['state'] = $RecipientList->state;
                $field['note'] = $RecipientList->note;
                $field['is_send'] = $RecipientList->is_send; // $field['recipients'] = new RecipientDetaileResource($RecipientList->recipients, $RecipientList->name);
                $field['Records'] = DistributionRecordResource::collection($RecipientList->distributionRecords->where('state', '=', 'Not'));
                $filtered[] = $field;
            }
        }
        return Response::json(['data' => $filtered], 200);

    }



    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\jsonResponse
     */
    public function reciveRecipientsList(Request $request)
    {
        $validator = $this->validate(
            $request,
            [
                'recipientListID' => 'required',
                'MyRecords' => 'required|array'
            ]
        );
        if ($validator->getData()->success) {


            $i = 0;

            foreach ($request->MyRecords as $record) {
                $result = DistributionRecordResource::make(
                    DistributionRecord::where('id', $record)
                    // ->where('recipientListID', $request->recipientListID)
                );
                if (!is_Null($result)) {
                    $result->update(['state' => 'deleverd']);
                }
                // $arr[] = $record->id;
                // $request->merge(["value {$i}" => $record]);
                // $i++;

            }
            $i = $validator->getData(true);
            $i['message'] = 'Records Updated Successfly';
            // dd($request->all());
            $ListRecords = RecipientsList::findOrFail($request->recipientListID)->distributionRecords;
            foreach ($ListRecords as $record) {
                if ($record->state != 'deleverd') {
                    $i['message'] .= ' ' . "but there still some records have not been deleverd";
                    $validator->setData($i);
                    return $validator;
                }
            }
            RecipientsList::where('id', $request->recipientListID)->update(['state' => 1]);
            $validator->setData($i);
            $i['message'] .= ' ' . 'and List Updated';
            return $validator;
        }
        return $validator;
    }
}