<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistributionRecordFlutter as DistributionRecordResource;
use App\Models\DistributionPoint;
use App\Http\Resources\DistributionPoint as DistributionPointResource;
use App\Http\Resources\User as UserResource;
use App\Models\DistributionRecord;
use App\Models\RecipientsList;
use Auth;
use Illuminate\Http\Request;
use Response;

class DistributerController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function login(Request $request)
    {
        $loginField = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $loginField => $request->input('email'),
            'password' => $request->input('password')
        ];


        if (Auth::attempt($credentials)) {
            if (auth()->user()->userType == 0) {
                $AccessToken = Auth::user()->createToken('Access Token')->accessToken;

                return Response([
                    'user' => UserResource::make(Auth::user()),
                    'Access Token' => $AccessToken
                ]);
            } else {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json([
                'message' => 'Invalid credentials or Token'
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     */

    public function downloadList($id)
    {
        $distributionPoint = DistributionPoint::findOrFail($id);
        if (auth()->user()->id == $distributionPoint->user->id) {
            $RecipientLists = $distributionPoint->recipientsLists;
            $field = array();
            $filtered = array();
            foreach ($RecipientLists as $RecipientList) {
                $RecipientList->state == null
                    ? $state = 0
                    : $state = $RecipientList->state;
                if ($RecipientList->is_send == 1 && $RecipientList->state == 0) {

                    $field['id'] = $RecipientList->id;
                    $field['name'] = $RecipientList->name;
                    $field['creationDate'] = date_format($RecipientList->created_at, 'Y-m-d');
                    $field['state'] = $state;
                    $field['note'] = $RecipientList->note;
                    $field['is_send'] = $RecipientList->is_send; // $field['recipients'] = new RecipientDetaileResource($RecipientList->recipients, $RecipientList->name);
                    $field['Records'] = DistributionRecordResource::collection($RecipientList->distributionRecords->where('state', '=', 'Not'));
                    $filtered[] = $field;
                }
            }
            return Response::json(['data' => $filtered], 200);
        } else {
            return response()->json(['message' => 'Forbbiden'], 403);
        }
    }
    public function refreshPoints()
    {
        $distributionPoints = DistributionPointResource::collection(auth()->user()->distributionPoints);
        return response()->json([
            'DistributionPoint' => $distributionPoints
        ], 200);
    }



    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\jsonResponse
     */
    public function UploadList(Request $request)
    {
        $validator = $this->validate(
            $request,
            [
                'recipientListID' => 'required',
                'MyRecords' => 'required|array'
            ]
        );
        if ($validator->getData()->success) {
            $list = RecipientsList::findOrFail($request->recipientListID);
            if (auth()->user()->id == $list->distributionPoint->userID) {


                $i = 0;

                foreach ($request->MyRecords as $record) {
                    $result = DistributionRecordResource::make(
                        DistributionRecord::where('id', $record)
                        // ->where('recipientListID', $request->recipientListID)
                    );
                    if (!is_Null($result)) {
                        $result->update(['state' => 'deleverd', 'recrptionDate' => now()]);
                    }
                    // $arr[] = $record->id;
                    // $request->merge(["value {$i}" => $record]);
                    // $i++;

                }
                $i = $validator->getData(true);
                $i['message'] = 'Records Updated Successfly';
                $ListRecords = $list->distributionRecords;
                foreach ($ListRecords as $record) {
                    if ($record->state != 'deleverd') {
                        $i['message'] .= ' ' . "but there still some records have not been deleverd";
                        $validator->setData($i);
                        return $validator;
                    }
                }
                RecipientsList::where('id', $request->recipientListID)->update(['state' => 1]);
                $i['message'] .= ' ' . 'and List Updated';
                $validator->setData($i);
                return $validator;

            } else {
                return response()->json(['message' => 'Forbbiden'], 403);
            }
        }
        return $validator;
    }
}