<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Resources\Address as AddressResource;
use Response;


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = AddressResource::collection(Address::all());
        return $item->response()->setStatusCode(200, "Items Returned Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validate(
            $request,
            [
                'country' => 'required',
                'city' => 'required',
                'neighborhood' => 'required',
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $item = new AddressResource(Address::create($request->all()));
            $i['message'] = "Address Created Succefully";
            $i['new value'] = $item;
            $validator->setData($i);
            return $validator;
        }
        return $validator;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Item = new AddressResource(Address::findOrFail($id));
        return $Item->response()->setStatusCode(200, "Address Returned Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validate(
            $request,
            [
                'country' => 'required',
                'city' => 'required',
                'neighborhood' => 'required',
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $Item = AddressResource::make(Address::findOrFail($id));
            $Item->update($request->all());
            $i['message'] = "Address Updated Succefully";
            $i['new value'] = $Item;
            $validator->setData($i);
            return $validator;
        }
        return $validator;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $Item = Address::findOrFail($id);
        $Item->delete();
        return Response::json(
            [
                $Item
            ],
            202
        );
    }
}