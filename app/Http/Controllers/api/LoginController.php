<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\API\BaseController as BaseController;

class LoginController extends BaseController
{


    function __construct()
    {
        $this->middleware('auth.basic.once');
    }

    public function login(Request $request)
    {
        $AccessToken = Auth::user()->createToken('Access Token')->accessToken;

        return Response(['user' => new UserResource(Auth::user()), 'Access Token' => $AccessToken]);
    }
}