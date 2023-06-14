<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DistributionPoint;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Response;
use App\Http\Resources\DistributionPoint as DistributionPointResource;


class DistributionPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $DistributionPoint = DistributionPointResource::collection(DistributionPoint::all());
        return $DistributionPoint->response()->setStatusCode(200, "DistributionPoints Returned Succefully")->
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
        $validator = $this->validate(
            $request,
            [
                'name' => 'required',
                'userID' => 'required',
                'addressDistriputions' => 'required',
                'addressID' => 'required',
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $DistributionPoint = new DistributionPointResource(DistributionPoint::create($request->all()));
            $i = $validator->getData(true);
            $i['message'] = "DistributionPoint Created Succefully";
            $i['new value'] = $DistributionPoint;
            $validator->setData($i);
            return $validator;
        }
        return $validator;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     */
    public function show($id)
    {
        $DistributionPoint = new DistributionPointResource(DistributionPoint::findOrFail($id));
        return $DistributionPoint->response()->setStatusCode(200, "DistributionPoint Returned Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DistributionPoint  $distributionPoint
     */
    public function edit(DistributionPoint $distributionPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     */
    public function update($id, Request $request)
    {
        $validator = $this->validate(
            $request,
            [
                'name' => 'required',
                'userID' => 'required',
                'state' => 'required',
                'addressDistriputions' => 'required',
                'addressID' => 'required',
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $DistributionPoint = new DistributionPointResource(DistributionPoint::findOrFail($id));
            $DistributionPoint->update($request->all());
            $i['message'] = "Distribution Point Updated Succefully";
            $i['new value'] = $DistributionPoint;
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
        $DistributionPoint = DistributionPoint::findOrFail($id);
        $DistributionPoint->delete();
        return Response::json(
            [
                $DistributionPoint
            ],
            202
        );
    }
}