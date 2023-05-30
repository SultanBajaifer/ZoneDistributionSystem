<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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