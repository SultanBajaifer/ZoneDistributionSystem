<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DistributionRecord as DistributionRecordResource;
use App\Http\Resources\Address as AddressResource;


class RecipientDetaile extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phoneNum' => $this->phoneNum,
            'barcode' => $this->barcode,
            'familyCount' => $this->familyCount,
            'distriputionPointID' => $this->distriputionPointID,
            'birthday' => $this->birthday,
            'averageSalary' => $this->averageSalary,
            'workFor' => $this->workFor,
            'passportNum' => $this->passportNum,
            'socialStatus' => $this->socialStatus,
            'residentType' => $this->residentType,
            'image' => $this->image,
            'address' => AddressResource::make($this->Address),
            // "Records" => DistributionRecordResource::collection($this->distriputionRecords),


        ];
    }
}