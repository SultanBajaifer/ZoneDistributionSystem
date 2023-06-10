<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Response;
use App\Http\Resources\Item as ItemResource;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $item = ItemResource::collection(Item::all());
        return $item->response()->setStatusCode(200, "Items Returned Succefully")->
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validate(
            $request,
            [
                'name' => 'required',
                'quentity' => 'required',
                'unit' => 'required',
                'packageID' => 'required',
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $item = new ItemResource(Item::create($request->all()));
            $i['message'] = "Item Created Succefully";
            $i['item'] = $item;
            $validator->setData($i);
            return $validator;
        }
        return $validator;
    }


    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {

        $Item = new ItemResource(Item::findOrFail($id));
        return $Item->response()->setStatusCode(200, "Item Returned Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     */
    public function edit(Item $item)
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
                'quentity' => 'required',
                'unit' => 'required',
                'packageID' => 'required',
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $Item = ItemResource::make(Item::findOrFail($id));
            $Item->update($request->all());
            $i['message'] = "Item Updated Succefully";
            $validator->setData($i);
            return $validator;
        }
        return $validator;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     */
    public function destroy($id)
    {
        $Item = Item::findOrFail($id);
        $Item->delete();
        return Response::json(
            [
                $Item
            ],
            202
        );
    }
}