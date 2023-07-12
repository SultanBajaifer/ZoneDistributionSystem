<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

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
            'date' => date_format($this->created_at, 'Y-m-d'),
            // 'user' => UserResource::make($this->user),
        ];
    }
}