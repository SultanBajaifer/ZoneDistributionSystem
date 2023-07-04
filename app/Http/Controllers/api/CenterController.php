<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RecipientsList;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Response;


class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = UserResource::collection(User::all());
        return $user->response()->setStatusCode(200, "User Returned Succefully")->
            header("Addestionl Header", "true");
    }
    /**
     * Search in the model.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */


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
                'email' => 'required',
                'password' => 'required'
            ]
        );
        if ($validator->getData()->success) {
            $emailArray = User::all()->pluck('email')->toArray();
            if (in_array($request->email, $emailArray)) {
                return response()->json(['message' => 'email already used'], 400);
            }
            $i = $validator->getData(true);
            if ($request->password != null) {
                $request['password'] = Hash::make($request->password);
            }


            $user = UserResource::make(User::create($request->all()));
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
                'email' => 'required',
                'addressID' => 'required'
            ]
        );
        if ($validator->getData()->success) {
            $emailArray = User::all()->pluck('email')->toArray();
            if (in_array($request->email, $emailArray)) {
                return response()->json(['message' => 'email already used'], 400);
            }
            $i = $validator->getData(true);
            if ($request->password != null)
                $request['password'] = Hash::make($request->password);
            // $idUser = User::findOrFail($id);
            // $this->authorize("update", $idUser);
            $user = UserResource::make(User::findorFail($id));
            $user->update($request->all());
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
        // $this->authorize("update", $data);
        $data->delete();
        return Response::json(
            [
                'Deleted User' => $data
            ],
            202
        );

    }
    function SendList($id)
    {
        $list = RecipientsList::findOrFail($id);
        $list->update(['is_send' => 1]);
        return response()->json(["Success" => "True", "Message" => "list is send"], 200);
    }
}