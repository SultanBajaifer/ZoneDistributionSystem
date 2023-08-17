<?php

namespace App\Http\Controllers\api;

use App\Models\DistributionRecord;
use App\Models\Package;
use App\Models\RecipientDetaile;
use App\Models\RecipientsList;
use App\Models\DistributionPoint as DistributionPointModel;
use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Response;
use App\Http\Resources\RecipientList_copy as RecipientsListResource;

class RecipientsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $RecipientList = RecipientsListResource::collection(RecipientsList::all());

        return $RecipientList->response()->setStatusCode(200, "Recipients Lists Returned Succefully")->
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

    public function listName(string $name)
    {
        if (RecipientsList::where('name', '=', $name)->count() > 0) {
            return 400;
        }
        return 200;
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
                "name" => "required",
                "note" => 'required',
            ]
        );
        $state = $this->listName($request->name);
        if ($state == 400) {
            return response()->json('There are list with this name', 400);
        }
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $item = RecipientsListResource::make(RecipientsList::create($request->all()));
            $i['message'] = "Item Created Succefully";
            $i['item'] = $item;
            $validator->setData($i);
            return $validator;
        }
        return $validator;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function complexStore(Request $request)
    {
        $validator = $this->validate(
            $request,
            [
                "name" => [
                    "required",
                    Rule::unique('recipientslist', 'name')
                ],
                "note" => 'required',
                "distriputionPointID" => 'required',
                "recipients" => ['required', 'array'],

            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $recipientList = RecipientsList::create($request->except(['recipients']));
            foreach ($request->recipients as $recipient) {
                $recipientList->recipients()->attach($recipient['recipientID'], [
                    'recipientName' => RecipientDetaile::findOrFail($recipient['recipientID'])->name,
                    "distriputionPointName" => $recipientList->distributionPoint->name,
                    "distriputerName" => $recipientList->distributionPoint->user->name,
                    "listName" => $recipientList->name,
                    'packageName' => Package::findOrFail($recipient['packageID'])->name,
                    'packageID' => $recipient['packageID']
                ]);
            }
            $i['message'] = "Recipient List Returned Succefully";
            $i['list'] = RecipientsListResource::make($recipientList);
            $validator->setData($i);
            return $validator;
        }
        return $validator;
    }

    /**
     * Display the specified resource.
     *
     * */
    public function show($id)
    {
        $RecipientList = RecipientsListResource::make(RecipientsList::findOrFail($id));
        return $RecipientList->response()->setStatusCode(200, "Recipient List Returned Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecipientsList  $recipientsList
     */
    public function edit(RecipientsList $recipientsList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validate(
            $request,
            [
                "name" => [
                    "required",
                    "string",
                    Rule::unique('recipientslist', 'name')->ignore($id)
                ],
                "note" => 'required',
                "recipients" => ['required', 'array'],

            ]
        );

        if ($validator->getData()->success) {
            $list = RecipientsList::findOrFail($id);
            $i = $validator->getData(true);
            $RecipientList = RecipientsListResource::make($list);
            if ($RecipientList->is_send == 0) {
                $RecipientList->update($request->except('recipients'));
                $RecipientList->Recipients()->detach();
                if ($request->recipients != null) {
                    foreach ($request->recipients as $recipient) {
                        $RecipientList->Recipients()->attach(
                            $recipient[
                                'recipientID'],
                            [
                                'recipientName' => RecipientDetaile::findOrFail($recipient['recipientID'])->name,
                                "distriputionPointName" => $RecipientList->distributionPoint->name,
                                "distriputerName" => $RecipientList->distributionPoint->user->name,
                                "listName" => $RecipientList->name,
                                'packageName' => Package::findOrFail($recipient['packageID'])->name,
                                'packageID' => $recipient['packageID']
                            ]
                        );
                    }
                }
                $i['message'] = "Recipient List Updated Succefully";
                $i['list'] = $RecipientList;
                $validator->setData($i);
                return $validator;
            }
            return Response::json([
                'success' => false,
                'message' => 'List Is already sended',
            ]);


        }
        return $validator;
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $data = RecipientsList::findOrFail($id);
        $data->delete();
        return Response::json(
            [
                "message" => `$data Deleted Succefully`
            ],
            202
        );
    }




    public function recipientListRecipients($id)
    {
        $list = RecipientsList::findOrFail($id);
        $distributionRecords = $list->distributionRecords;
        $field = array();
        $filtered = array();
        foreach ($distributionRecords as $record) {
            $field['id'] = $record->recipientDetails->id;
            $field['name'] = $record->recipientDetails->name;
            $field['phoneNum'] = $record->recipientDetails->phoneNum;
            $field['barcode'] = $record->recipientDetails->barcode;
            $field['familyCount'] = $record->recipientDetails->familyCount;
            $field['addressID'] = $record->recipientDetails->addressID;
            $field['birthday'] = $record->recipientDetails->birthday;
            $field['averageSalary'] = $record->recipientDetails->averageSalary;
            $field['workFor'] = $record->recipientDetails->workFor;
            $field['passportNum'] = $record->recipientDetails->passportNum;
            $field['socialState'] = $record->recipientDetails->socialState;
            $field['residentType'] = $record->recipientDetails->residentType;
            $field['package'] = $record->package;
            $filtered[] = $field;
        }
        return Response::json(["list" => $list, 'recipients' => $filtered], 200);
    }
}