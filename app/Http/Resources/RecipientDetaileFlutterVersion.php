<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DistributionRecord as DistributionRecordResource;
// use App\Http\Resources\RecipientList as RecipientListResource;
use App\Models\RecipientsList as RecipientListModel;
use Intervention\Image\Facades\Image;



class RecipientDetaileFlutterVersion extends JsonResource
{
    public string $MyListName;

    public function __construct($resource, $listName)
    {
        parent::__construct($resource);
        $this->MyListName = $listName;
        // dd($this->MyListName);
    }

    // protected $list = $this->name;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = '';
        if ($this->hasMedia()) {
            $mediaItems = $this->getMedia()->first();
            $path = $mediaItems->getPath();
            $stream = Image::make($path)->stream('jpg', 60);
            $image = base64_encode($stream);
        }

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
            'image' => $image,
            "Records" => DistributionRecordResource::collection($this->distriputionRecords)


        ];
    }
}