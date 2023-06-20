<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DistributionPoint as DistributionPointResource;
use App\Http\Resources\DistributionRecord_copy as DistributionRecordResource;


class RecipientList_copy extends JsonResource
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
            'creationDate' => date_format($this->created_at, 'Y-m-d'),
            'state' => $this->state,
            'note' => $this->note,
            'is_send' => $this->is_send,
            'records' => DistributionRecordResource::collection($this->distributionRecords),
            // "recipients" => RecipientsResource::collection($this->Recipients),
            "distributionPoint" => DistributionPointResource::make($this->distributionPoint),

        ];
    }
}