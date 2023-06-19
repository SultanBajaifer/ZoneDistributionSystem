<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Address as AddressResource;
use App\Http\Resources\DistributionPoint_login as DistributionPointResource;

class User_copy extends JsonResource
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
            'userName' => $this->userName,
            'email' => $this->email,
            'password' => $this->password,
            'userType' => $this->userType,
            'address' => AddressResource::make($this->Address),
            'DistributionPoint' => DistributionPointResource::collection($this->DistributionPoints),
        ];
    }
}
