<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RecipientDetaile as RecipientsResource;
use App\Http\Resources\DistributionPoint as DistributionPointResource;
use App\Http\Resources\Address as AddressResource;


class RecipientList extends JsonResource
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
            'creationDate' => $this->creationDate,
            'state' => $this->state,
            'note' => $this->note,
            "recipients" => RecipientsResource::collection($this->Recipients),
            "distributionPoints" => DistributionPointResource::make($this->distributionPoint),

        ];
    }
}