<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistributionRecordFlutter as DistributionRecordResource;
use App\Http\Resources\RecipientList;
use App\Models\DistributionPoint;
use App\Models\DistributionRecord;
use App\Models\RecipientsList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Response;
use App\Rules\JsonParams;
use Illuminate\Support\Facades\Validator;

class flutterController extends Controller
{

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