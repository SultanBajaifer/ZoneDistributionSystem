<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecipientDetaileFlutterVersion as RecipientDetaileResource;
use App\Http\Resources\RecipientList;
use App\Http\Resources\DistributionRecord as DistributionRecordResource;
use App\Http\Resources\RecipientsListFlutterVersion as RecipientListResource;
use App\Models\DistributionPoint;
use App\Models\DistributionRecord;
use App\Models\RecipientDetaileFlutterVersion;
use App\Models\RecipientsList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Response;

class flutterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\jsonResponse
     */
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
                $field['Records'] = DistributionRecordResource::collection($RecipientList->distributionRecords);
                $filtered[] = $field;
            }
        }
        return Response::json(['data' => $filtered], 200);

    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function reciveRecipientsList($id)
    {

        $RecipientList = RecipientsListFlutterVersion::collection(RecipientsList::find($id));
        return $RecipientList->response()->setStatusCode(200, "Recipients Lists Returned Succefully")->
            header("Addestionl Header", "true");
    }


}