<?php

namespace App\Http\Controllers\api;

use App\Models\DistributionPoint;
use App\Http\Resources\DistributionRecordFlutter as DistributionRecordResource;
use App\Models\DistributionRecord;
use App\Models\RecipientsList;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
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