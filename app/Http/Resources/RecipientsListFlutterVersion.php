<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RecipientDetaileFlutterVersion as RecipientsResource;
use App\Http\Resources\DistributionPoint as DistributionPointResource;
use App\Http\Resources\DistributionRecord as DistributionRecordResource;


class RecipientsListFlutterVersion extends JsonResource
{
    private $name;


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $name = $this->name;
        return [

            'id' => $this->id,
            'name' => $name,
            'creationDate' => $this->creationDate,
            'state' => $this->state,
            'note' => $this->note,
            'is_send' => $this->is_send,
            "distributionPoints" => DistributionPointResource::make($this->distributionPoint),
            // 'recipients' => RecipientsResource::collection($this->Recipients, 'fouh'),
            'records' => $this->distributionRecords,
            // 'recipients' => RecipientsResource::collection($this->Recipients, $this->name),

            // 'records' => $records,
        ];
    }
}