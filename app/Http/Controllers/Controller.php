<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function validate(Request $request, array $defaultArray)
    {

        $validator = Validator::make($request->all(), $defaultArray);

        // Check if validation fails
        if ($validator->fails()) {
            return Response::json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'tip' => 'please follow the syntax',
                'Syntax' => $defaultArray
            ], 400);
        }
        return Response::json([
            'success' => true,
            'message' => 'Completed',


        ], 200);
    }
    public function search($model, $value, $name = 'name', $filter = null, $ascOrDesc = 'ASC')
    {

        $query = "SELECT * FROM `$model` WHERE `$name` LIKE '%$value%'";
        $filter != null ? $query .= "ORDER BY `$model`.`$filter`" : $query;

        $ascOrDesc != 'ASC' ? $query .= "DESC" : $query;
        $result = DB::select($query);
        // $result = DB::table($model)
        //     ->where($name, 'like', '%$value%')
        //     ->orderBy($filter, $ascOrDesc)
        //     ->get();

        return $result;
    }


}