<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Package as PackageResource;


class DistributionRecord extends JsonResource
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
            'recipientID' => $this->recipientID,
            'recrptionDate' => $this->recrptionDate,
            'state' => $this->state,
            'recipientListID' => $this->recipientListID,
            'recipientName' => $this->recipientName,
            'listName' => $this->listName,
            'distriputionPointName' => $this->distriputionPointName,
            'distriputerName' => $this->distriputerName,
            "package" => PackageResource::make($this->package),

        ];
    }
}