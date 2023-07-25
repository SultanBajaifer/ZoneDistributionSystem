<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Models\Complaint;
use App\Mail\Complaints as ComplaintMail;
use App\Models\RecipientDetaile;
use App\Models\User;
use DB;
use Http;
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
        // dd($request->all());
        $validator = $this->validate(
            $request,
            [
                'complainterName' => 'required',
                'discription' => 'required',
                'passportNum' => 'required',
                'email' => 'required|email',
                'username' => ['nullable', new \App\Rules\Honeypot],
            ]
        );
        if ($validator->getData()->success) {
            $passport = RecipientDetaile::where('passportNum', $request->input('passportNum'))->count();
            if ($passport == 1) {

                $center = User::where('userType', 1)->first();
                $Complaint = new ComplaintResource(Complaint::create([
                    'complainterName' => $request->complainterName,
                    'discription' => $request->discription,
                    'email' => $request->email,
                    'userID' => $center->id
                ]));
                $email = $request->only('email');
                if ($Complaint) {
                    if ($this->is_connected()) {

                        Mail::to($email)->send(new ComplaintMail($request->only(['email', 'complainterName'])));
                        $i = $validator->getData(true);
                        return redirect()->route('thinksForComplaint');
                        ;

                    } else {
                        return redirect()->route('thinksForComplaint');

                    }
                }
            }
            return redirect()->back();
        }
        return $validator;

    }
    function is_connected()
    {
        $connected = @fsockopen("www.google.com", 80);
        //website, port  (try 80 or 443)
        if ($connected !== false) {
            $is_conn = true; //action when connected
            fclose($connected);
        } else {
            $is_conn = false; //action in connection failure
        }
        return $is_conn;

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
}
