<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DistributionRecord as DistributionRecordResource;


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
            'addressID' => $this->addressID,
            'distriputionPointID' => $this->distriputionPointID,
            'birthday' => $this->namebirthday,
            'averageSalary' => $this->averageSalary,
            'workFor' => $this->workFor,
            'passportNum' => $this->passportNum,
            'socialStatus' => $this->socialStatus,
            'residentType' => $this->residentType,
            'image' => $this->image,
            "Records" => DistributionRecordResource::collection($this->distriputionRecords),


        ];
    }
}