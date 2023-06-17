<?php

namespace App\Http\Resources;

use App\Models\RecipientsList;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DistributionRecord as DistributionRecordResource;
use App\Http\Resources\RecipientList as RecipientsListResource;
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
            'birthday' => $this->birthday,
            'averageSalary' => $this->averageSalary,
            'workFor' => $this->workFor,
            'passportNum' => $this->passportNum,
            'socialState' => $this->socialState,
            'residentType' => $this->residentType,
            'image' => $this->image,
            'addresses' => AddressResource::make($this->Address),
            // 'RecipientsList' => RecipientsListResource::collection($this->RecipientsList),
            "Records" => DistributionRecordResource::collection($this->distriputionRecords),


        ];
    }
}