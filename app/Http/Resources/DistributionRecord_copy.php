<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Package as PackageResource;
use Intervention\Image\Facades\Image;


class DistributionRecord_copy extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = '';
        if ($this->recipientDetails->hasMedia()) {
            $mediaItems = $this->recipientDetails->getMedia()->first();
            $path = $mediaItems->getPath();
            $stream = Image::make($path)->stream('jpg', 60);
            $image = base64_encode($stream);
        }
        if ($this->recrptionDate != null) {
            $dateTime = new DateTime($this->recrptionDate);
            $date = $dateTime->format('Y-m-d');
        } else {
            $date = '0000-00-00';
        }
        return [
            'id' => $this->id,
            'recrptionDate' => $date,
            'state' => $this->state,
            'recipientListID' => $this->recipientListID,
            'recipientName' => $this->recipientName,
            'listName' => $this->listName,
            'distriputionPointName' => $this->distriputionPointName,
            'distriputerName' => $this->distriputerName,
            'recipient' => $this->recipientDetails,
            'image' => $image,
            "package" => PackageResource::make($this->package),

        ];
    }
}