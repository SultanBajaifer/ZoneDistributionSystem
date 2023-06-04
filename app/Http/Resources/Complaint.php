<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Complaint extends JsonResource
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
            'complainterName' => $this->complainterName,
            'discription' => $this->discription,
            'email' => $this->email,
            'userID' => $this->userID,
            'date' => $this->date
        ];
    }
}