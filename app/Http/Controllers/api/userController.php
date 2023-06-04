<?php

namespace App\Http\Controllers\api;

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
        return $this->search(
            'users',
            $searchValue,
            'userName',
            $request->filter,
            $searchAscOrDesc
        );

        // $result = DB::table('users')->where('userName', $request->value)->get()->toJson();
        // return response()->json($result, 200);
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
}