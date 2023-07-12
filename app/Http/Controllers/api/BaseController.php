<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DistributionRecord;
use App\Models\RecipientDetaile;
use Illuminate\Http\Request;
use App\Http\Resources\RecipientDetaile as RecipientDetailesResource;
use App\Http\Resources\DistributionRecord as DistributionRecordResource;


class BaseController extends Controller
{
    public function querySearch(Request $request)
    {
        $searchValue = isset($request->value) ? $request->value : 'name';
        $searchAscOrDesc = $request->ascOrDesc == "desc" ? "DESC" : 'ASC';
        $filter = array();
        $filter['addresses'] = $this->search(
            'addresses',
            $searchValue,
            'country',
            $request->filter,
            $searchAscOrDesc,
        );

        $filter['complaints'] = $this->search(
            'complaints',
            $searchValue,
            'complainterName',
            $request->filter,
            $searchAscOrDesc,
        );
        $filter['distributionPoints'] = $this->search(
            'distributionPoints',
            $searchValue,
            'name',
            $request->filter,
            $searchAscOrDesc,
        );
        $filter['packages'] = $this->search(
            'packages',
            $searchValue,
            'name',
            $request->filter,
            $searchAscOrDesc,
        );
        $filter['recipientDetailes'] = $this->search(
            'recipientdetailes',
            'sultan',
            'name',
            $request->filter,
            $searchAscOrDesc,
        );
        $filter['recipientsLists'] = $this->search(
            'recipientslist',
            $searchValue,
            'name',
            $request->filter,
            $searchAscOrDesc,
        );
        $filter['users'] = $this->search(
            'users',
            $searchValue,
            'userName',
            $request->filter,
            $searchAscOrDesc,
        );
        $item['items'] = $this->search(
            'items',
            $searchValue,
            'name',
            $request->filter,
            $searchAscOrDesc,
        );
        return response()->json($filter, 200);
    }
    public function home()
    {
        $recipients = RecipientDetailesResource::collection(RecipientDetaile::all()->sortByDesc('created_at')->take(8));
        $distributionRecords = DistributionRecordResource::collection(DistributionRecord::all()->sortByDesc('created_at')->take(8));
        return response()->json([
            'recipients' => $recipients,
            'distributionRecord' => $distributionRecords
        ], 200);
    }
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

}