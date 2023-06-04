<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RecipientDetaile;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Response;
use App\Http\Resources\RecipientDetaile as RecipientDetaileResource;
use Picqer\Barcode\BarcodeGenerator;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Str;

class RecipientDetaileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $RecipientDetaile = RecipientDetaileResource::collection(RecipientDetaile::all());
        return $RecipientDetaile->response()->setStatusCode(200, "Recipient Returned Succefully")->
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
     */
    public function store(Request $request)
    {
        $validator = $this->validate(
            $request,
            [
                "name" => "required",
                "phoneNum" => 'required',
                "familyCount" => 'required',
                "addressID" => 'required',
                "distriputionPointID" => 'required',
                "averageSalary" => 'required',
                "workFor" => 'required',
                "passportNum" => 'required',
                "socialStatus" => 'required',
                "residentType" => 'required',
                "image" => 'required',
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $userCount = RecipientDetaile::count();
            $random = random_int(1000000, 8999999);
            ;
            $userCount += $random;

            // Generate a unique barcode number for the new user
            $barcodeNumber = 'RECIPIENT' . str_pad($userCount + 1, 7, '0', STR_PAD_BOTH);
            $request->merge(['birthday' => now(), 'barcode' => $barcodeNumber]);
            $recipient = RecipientDetaileResource::make(
                RecipientDetaile::create($request->all())
            );

            // $generator = new BarcodeGeneratorJPG();

            // // Generate barcode
            // $barcodeImage = $generator->getBarcode($barcodeNumber, $generator::TYPE_CODE_128, 2, 30);
            // // Save barcode image to file
            // file_put_contents(public_path('barcodes/' . $barcodeNumber . '.png'), $barcodeImage);
            // file_put_contents(public_path('barcodes/' . $barcodeNumber . '.png'), $fileContents);
            $i['message'] = "Recipient Created Succefully";
            $i['new value'] = $recipient;
            $validator->setData($i);
            return $validator;
        }
        return $validator;
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     */
    public function show($id)
    {
        $RecipientDetaile = new RecipientDetaileResource(RecipientDetaile::findOrFail($id));
        return $RecipientDetaile->response()->setStatusCode(200, "Recipient Detailes Returned Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecipientDetaile  $recipientDetaile
     */
    public function edit(RecipientDetaile $recipientDetaile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     */
    public function update($id, Request $request)
    {
        $validator = $this->validate(
            $request,
            [
                "name" => "required",
                "phoneNum" => 'required',
                "familyCount" => 'required',
                "addressID" => 'required',
                "distriputionPointID" => 'required',
                "averageSalary" => 'required',
                "workFor" => 'required',
                "passportNum" => 'required',
                "socialStatus" => 'required',
                "residentType" => 'required',
                "image" => 'required',
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $RecipientDetaile = new RecipientDetaileResource(RecipientDetaile::findOrFail($id));
            $RecipientDetaile->update($request->all());
            $i['message'] = "Recipient Details Updated Succefully";
            $i['new value'] = $RecipientDetaile;
            $validator->setData($i);
            return $validator;
        }
        return $validator;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     */
    public function destroy($id)
    {
        $RecipientDetaile = RecipientDetaile::findOrFail($id);
        $RecipientDetaile->delete();
        return Response::json(
            [
                $RecipientDetaile
            ],
            202
        );
    }
}