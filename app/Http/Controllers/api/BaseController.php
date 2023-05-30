<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


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