<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Package as PackageResource;


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
        $recipient = $this->recipientDetails;
        return [
            'id' => $this->recipientID,
            'recipientName' => $recipient->name,
            'recrptionDate' => $recipient->phoneNum,
            'barcode' => $recipient->barcode,
            'familyCount' => $recipient->familyCount,
            'birthday' => $recipient->birthday,
            'averageSalary' => $recipient->averageSalary,
            'workFor' => $recipient->workFor,
            'passportNum' => $recipient->passportNum,
            "socialStatus" => $recipient->socialStatus,
            "residentType" => $recipient->residentType,
            "recordID" => $this->id,

        ];
    }
}