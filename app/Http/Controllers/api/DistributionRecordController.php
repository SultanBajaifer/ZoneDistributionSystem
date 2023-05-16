<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DistributionRecord;
use Illuminate\Http\Request;

use App\Http\Resources\DistributionRecord as DistributionRecordResource;
use Response;

class DistributionRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $DistributionRecord = DistributionRecordResource::collection(DistributionRecord::all());
        return $DistributionRecord->response()->setStatusCode(200, "DistributionRecords Returned Succefully")->
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
        $DistributionRecord = new DistributionRecordResource(DistributionRecord::create($request->all()));
        return $DistributionRecord->response()->setStatusCode(200, "DistributionRecord Created Succefully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $DistributionRecord = new DistributionRecordResource(DistributionRecord::findOrFail($id));
        return $DistributionRecord->response()->setStatusCode(200, "DistributionRecord Returned Succefully")->
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
        $DistributionRecord = new DistributionRecordResource(DistributionRecord::findOrFail($id));
        $DistributionRecord->update($request->all());
        return $DistributionRecord->response()->setStatusCode(200, "DistributionRecord Updated Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $DistributionRecord = DistributionRecord::findOrFail($id);
        $DistributionRecord->delete();
        return Response::json(
            [
                $DistributionRecord
            ],
            202
        );
    }
}
