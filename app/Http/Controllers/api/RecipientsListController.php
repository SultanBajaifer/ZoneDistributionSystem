<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\DistributionPoint;
use App\Models\DistributionRecord;
use App\Models\Package;
use App\Models\RecipientsList;
use App\Models\DistributionPoint as DistributionPointModel;
use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Response;
use App\Http\Resources\RecipientList as RecipientListResource;

class RecipientsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $RecipientList = RecipientListResource::collection(RecipientsList::all());

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
        // return Response::json(
        //     [
        //         "List" => $request->except(['recipients', 'distributionPoint','distriputer']),
        //         "recipients" => $request->recipients,
        //         "point" => $request->distriputionPoint,
        //         "pointName" => DistributionPointModel::findOrFail($request->distriputionPoint)->name,
        //         "distriputer" => $request->distriputer,
        //         "distriputerName" => UserModel::findOrFail($request->distriputer)->name

        //     ],
        //     202
        // );

        try {

            $recipientList = new RecipientListResource(RecipientsList::create($request->except(['recipients'])));
            $recipientList->DistributionPoint()->attach($request->distriputionPoint);
            foreach ($request->recipients as $recipient) {
                $recipientList->Recipients()->attach($recipient[0]);
                DistributionRecord::create([
                    'recipientID' => $recipient[0],
                    'recrption' => $recipientList->creationDate,
                    'state' => "Not",
                    "distriputionPointName" => DistributionPointModel::findOrFail($request->distriputionPoint)->name,
                    "distriputerName" => UserModel::findOrFail($request->distriputer)->name,
                    "ListName" => $recipientList->name,
                    'packageName' => Package::findOrFail($recipient[1])->name,
                    'packageID' => $recipient[1]
                ]);
            }
            return $recipientList->response()->setStatusCode(200, "Recipient List Returned Succefully")->
                header("Addestionl Header", "true");
        } catch (\Throwable $th) {
            return response()->json([
                $th->getMessage()
            ], 405);
        }

        // $RecipientList = new RecipientListResource(RecipientsList::create($request->except(['users'])));
        // return $RecipientList->response()->setStatusCode(200, "Recipient List Created Succefully");
    }

    /**
     * Display the specified resource.
     *
     * */
    public function show($id)
    {
        $RecipientList = new RecipientListResource(RecipientsList::findOrFail($id));
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
        $RecipientList = new RecipientListResource(RecipientsList::findOrFail($id));
        $RecipientList->update($request->all());
        return $RecipientList->response()->setStatusCode(200, "Recipient List Updated Succefully")->
            header("Addestionl Header", "true");
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
}