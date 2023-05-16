<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Mail\Complaints as ComplaintMail;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Http\Resources\Complaint as ComplaintResource;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $Complaint = ComplaintResource::collection(Complaint::all());
        return $Complaint->response()->setStatusCode(200, "Complaints Returned Succefully")->
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        if ($validator->fails()) {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => $validator->errors()
                ],
                422
            );
        }
        $admin = User::where('userType', 1)->first();
        $Complaint = new ComplaintResource(Complaint::create([
            'complainterName' => $request->complainterName,
            'discription' => $request->discription,
            'email' => $request->email,
            'date' => date('Y-m-d H:i:s'),
            'userID' => $admin->id
        ]));
        $email = $request->only('email');
        if ($Complaint) {
            Mail::to($email)->send(new ComplaintMail($request->only(['email', 'complainterName'])));
            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "Thank you for subscribing to our email, please check your inbox"
                ],
                200
            );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int
     */
    public function show($id)
    {

        $Complaint = new ComplaintResource(Complaint::findOrFail($id));
        return $Complaint->response()->setStatusCode(200, "Complaint Returned Succefully")->
            header("Addestionl Header", "true");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     */
    public function edit($id, Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     */
    public function update(Request $request, Complaint $complaint)
    {
        return Response::json(['error' => 'You Cant Edit a Complaints'], 402);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     */
    public function destroy(Complaint $complaint)
    {
        return Response::json(['error' => "Delete a Complaint", 404]);
    }
}