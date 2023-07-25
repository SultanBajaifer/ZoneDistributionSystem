<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Package as PackageResource;
use Intervention\Image\Facades\Image;


class DistributionRecordFlutter extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->recrptionDate == null
            ? $recrptionDate = "0000-00-00"
            : $recrptionDate = $this->recrptionDate;
        $recipient = $this->recipientDetails;
        $image = '';
        if ($recipient->hasMedia()) {
            $mediaItems = $recipient->getMedia()->first();
            $path = $mediaItems->getPath();
            $stream = Image::make($path)->stream('jpg', 60);
            $image = base64_encode($stream);
        }


        return [
            'id' => $this->recipientID,
            'recipientName' => $recipient->name,
            'recrptionDate' => $recrptionDate,
            'barcode' => $recipient->barcode,
            'phoneNum' => $recipient->phoneNum,
            'familyCount' => $recipient->familyCount,
            'birthday' => $recipient->birthday,
            'averageSalary' => $recipient->averageSalary,
            'workFor' => $recipient->workFor,
            'passportNum' => $recipient->passportNum,
            "socialState" => $recipient->socialState,
            "residentType" => $recipient->residentType,
            'pacakgeName' => $this->packageName,
            'image' => $image,
            "recordID" => $this->id,

        ];


    }
}