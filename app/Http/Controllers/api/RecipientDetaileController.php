<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RecipientDetaile;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Response;
use App\Http\Resources\RecipientDetaile as RecipientDetaileResource;
use Picqer\Barcode\BarcodeGenerator;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Spatie\MediaLibrary;
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
    public function CreateBarcode($n = 1, $barcodeArray = [])
    {
        $random = random_int(1000000, 8999999);

        $random +=
            $n;
        $barcodeNumber = str_pad($random + 1, 8, '0', STR_PAD_BOTH);
        if (!in_array($barcodeNumber, $barcodeArray)) {
            return $barcodeNumber;
        }
        $n++;
        return $this->CreateBarcode($n, $barcodeArray);

        // Generate a unique barcode number for the new user
    }

    function Barcode()
    {
        $barrcodeArray = RecipientDetaile::all()->pluck('barcode')->toArray();
        return $this->CreateBarcode(1, $barrcodeArray);

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
                "birthday" => "required|date",
                "addressID" => 'required',
                "averageSalary" => 'required',
                "workFor" => 'required',
                "passportNum" => [
                    "required",
                    Rule::unique('RecipientDetailes', 'passportNum')
                ],
                "socialState" => 'required',
                "residentType" => 'required'
            ]
        );
        if ($validator->getData()->success) {

            $i = $validator->getData(true);

            // Generate a unique barcode number for the new user
            $request->merge(['barcode' => $this->Barcode()]);
            $recipient = RecipientDetaileResource::make(
                RecipientDetaile::create($request->only([
                    'name',
                    'phoneNum',
                    'familyCount',
                    'birthday',
                    'addressID',
                    'averageSalary',
                    'barcode',
                    'workFor',
                    'passportNum',
                    'socialState',
                    'residentType'
                ]))
            );
            if ($request->hasFile('image') && $request->file('image') != null && $request->file('image') != '') {

                $last_recipient = RecipientDetaile::latest()->first();
                $last_recipient->addMedia($request->file('image'))
                    ->toMediaCollection();
            }


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
                "birthday" => "required",
                "addressID" => 'required',
                "averageSalary" => 'required',
                "workFor" => 'required',
                "passportNum" => [
                    "required",
                    Rule::unique('RecipientDetailes', 'passportNum')->ignore($id)
                ],
                "socialState" => 'required',
                "residentType" => 'required'
            ]
        );
        if ($validator->getData()->success) {
            $i = $validator->getData(true);
            $RecipientDetaile = RecipientDetaile::findOrFail($id);
            $RecipientDetaile->update($request->only([
                'name',
                'phoneNum',
                'familyCount',
                'birthday',
                'addressID',
                "averageSalary",
                'workFor',
                'passportNum',
                'socialState',
                'residentType'
            ]));

            // Replace the old image with the new one
            if ($request->hasFile('image') && $request->file('image') != null && $request->file('image') != '') {
                $RecipientDetaile->clearMediaCollection();
                $RecipientDetaile->addMedia($request->file('image'))
                    ->toMediaCollection();
            }


            $i['message'] = "Recipient Details Updated Succefully";
            $i['new value'] = new RecipientDetaileResource($RecipientDetaile);
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
        $RecipientDetaile->clearMediaCollection();
        $RecipientDetaile->delete();
        return Response::json(
            [
                $RecipientDetaile
            ],
            202
        );
    }
}