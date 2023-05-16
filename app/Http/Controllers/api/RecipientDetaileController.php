<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RecipientDetaile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Response;
use App\Http\Resources\RecipientDetaile as RecipientDetaileResource;


class RecipientDetaileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $RecipientDetaile = RecipientDetaileResource::collection(RecipientDetaile::all());
        return $RecipientDetaile->response()->setStatusCode(200, "Recipient Returned Succefully")->
            header("Addestionl Header", "true");
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
     */
    public function store(Request $request)
    {
        $RecipientDetaile = new RecipientDetaileResource(RecipientDetaile::create($request->all()));
        return $RecipientDetaile->response()->setStatusCode(200, "Recipient Created Succefully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     */
    public function show($id)
    {
        $RecipientDetaile = new RecipientDetaileResource(RecipientDetaile::findOrFail($id));
        return $RecipientDetaile->response()->setStatusCode(200, "Recipient Detailes Returned Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecipientDetaile  $recipientDetaile
     */
    public function edit(RecipientDetaile $recipientDetaile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     */
    public function update($id, Request $request)
    {
        $RecipientDetaile = new RecipientDetaileResource(RecipientDetaile::findOrFail($id));
        $RecipientDetaile->update($request->all());
        return $RecipientDetaile->response()->setStatusCode(200, "Recipient Details Updated Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     */
    public function destroy($id)
    {
        $RecipientDetaile = RecipientDetaile::findOrFail($id);
        $RecipientDetaile->delete();
        return Response::json(
            [
                $RecipientDetaile
            ],
            202
        );
    }
}