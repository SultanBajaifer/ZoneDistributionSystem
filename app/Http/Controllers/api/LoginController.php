<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User_copy as UserResource;
use App\Http\Controllers\API\BaseController as BaseController;

class LoginController extends BaseController
{


    function __construct()
    {
        // $this->middleware('auth.basic.once');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $AccessToken = Auth::user()->createToken('Access Token')->accessToken;

            return Response([
                'user' => new UserResource(Auth::user())
                ,
                'Access Token' => $AccessToken
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    }
}