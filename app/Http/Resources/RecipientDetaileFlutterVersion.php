<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DistributionRecord as DistributionRecordResource;
// use App\Http\Resources\RecipientList as RecipientListResource;
use App\Models\RecipientsList as RecipientListModel;



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
            'image' => $this->MyListName,
            "Records" => DistributionRecordResource::collection($this->distriputionRecords)


        ];
    }
}