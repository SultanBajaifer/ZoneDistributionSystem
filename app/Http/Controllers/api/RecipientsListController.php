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
                "name" => "required",
                "note" => 'required',
                "distriputionPointID" => 'required',
                "recipients" => 'required|array',

            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $recipientList = RecipientsList::create($request->except(['recipients']));
            foreach ($request->recipients as $recipient) {
                $recipientList->recipients()->attach($recipient['recipientID'], [
                    'recipientName' => RecipientDetaile::findOrFail($recipient['recipientID'])->name,
                    "distriputionPointName" => $recipientList->distributionPoint->name,
                    "distriputerName" => $recipientList->distributionPoint->name,
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
                "name" => "required",
                "note" => 'required',
                "distriputionPointID" => 'required',
                "is_send" => 'required',

            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $RecipientList = RecipientsListResource::make(RecipientsList::findOrFail($id));
            $RecipientList->update($request->all());
            $i['message'] = "Recipient List Updated Succefully";
            $i['list'] = $RecipientList;
            $validator->setData($i);
            return $validator;

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

    function send($id)
    {
        $list = RecipientsList::findOrFail($id);
        $list->update(['is_send' => 1]);
        return response()->json(["Success" => "True", "Message" => "list is send"], 200);
    }

    function complexUpdate(Request $request, $id)
    {
        $list = RecipientsList::findOrFail($id);
        $list->Recipients()->detach();
        foreach ($request->recipients as $recipient) {
            $list->Recipients()->attach(
                $recipient[
                    'recipientID'],
                [
                    'recipientName' => RecipientDetaile::findOrFail($recipient['recipientID'])->name,
                    "distriputionPointName" => $list->distributionPoint->name,
                    "distriputerName" => $list->distributionPoint->name,
                    "listName" => $list->name,
                    'packageName' => Package::findOrFail($recipient['packageID'])->name,
                    'packageID' => $recipient['packageID']
                ]
            );
        }
        return response()->json(["Success" => "true", "Message" => "List Records are updated"], 200);
    }
}