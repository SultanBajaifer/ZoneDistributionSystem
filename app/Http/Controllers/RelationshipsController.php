<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Package;
use App\Models\RecipientDetaile;
use App\Models\RecipientsList;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class RelationshipsController extends Controller
{

    # User Functions
    public function userDistributionPoints($id)
    {
        $points = User::findOrFail($id)->DistributionPoints;
        $field = array();
        $filtered = array();
        foreach ($points as $DistributionPoints) {
            $field['id'] = $DistributionPoints->id;
            $field['name'] = $DistributionPoints->name;
            $field['state'] = $DistributionPoints->state;
            $filtered[] = $field;
        }
        return Response::json(['data' => $filtered], 200);
    }
    public function userComplaints($id)
    {
        $complaints = User::findOrFail($id)->Complaints;
        $field = array();
        $filtered = array();
        foreach ($complaints as $Complaint) {
            $field['id'] = $Complaint->id;
            $field['complainterName'] = $Complaint->complainterName;
            $field['discription'] = $Complaint->discription;
            $field['date'] = $Complaint->date;
            $filtered[] = $field;
        }
        return Response::json(['data' => $filtered], 200);
    }
    public function userAddress($id)
    {
        $Addresses = User::findOrFail($id)->Address;
        $field = array();
        $filtered = array();
        foreach ($Addresses as $address) {
            $field['id'] = $address->id;
            $field['country'] = $address->country;
            $field['city'] = $address->city;
            $field['neighborhood'] = $address->neighborhood;
            $filtered[] = $field;
        }
        return Response::json(['data' => $filtered], 200);
    }

    # Package Functions
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function packageItems($id)
    {
        $Items = Package::findOrFail($id)->Items;
        $field = array();
        $filtered = array();
        foreach ($Items as $Item) {
            $field['id'] = $Item->id;
            $field['name'] = $Item->name;
            $field['quantity'] = $Item->quantity;
            $field['unit'] = $Item->unit;
            $filtered[] = $field;
        }
        return Response::json(['data' => $filtered], 200);
    }

    #items Functions
    public function itemPackage($id)
    {
        $package = Item::findOrFail($id)->package;
        return Response()->json([
            'data' => $package,

        ], 200);
    }

    # RecipientList Functions
    public function recupientListRecipients($id)
    {
        $list = RecipientsList::findOrFail($id);
        $Recipients = $list->Recipients;
        $field = array();
        $filtered = array();
        foreach ($Recipients as $Recipient) {
            $field['id'] = $Recipient->id;
            $field['name'] = $Recipient->name;
            $field['phoneNum'] = $Recipient->phoneNum;
            $field['barcode'] = $Recipient->barcode;
            $field['familyCount'] = $Recipient->familyCount;
            $field['addressID'] = $Recipient->addressID;
            $field['birthday'] = $Recipient->birthday;
            $field['averageSalary'] = $Recipient->averageSalary;
            $field['workFor'] = $Recipient->workFor;
            $field['passportNum'] = $Recipient->passportNum;
            $field['socialStatus'] = $Recipient->socialStatus;
            $field['residentType'] = $Recipient->residentType;
            $field['records'] = $Recipient->distriputionRecords->where('listName', $list->name);
            $filtered[] = $field;
        }
        return Response::json(['data' => $filtered], 200);
    }
    public function recupientListDistributionPoints($id)
    {
        $DistributionPoints = RecipientsList::findOrFail($id)->DistributionPoints;
        $field = array();
        $filtered = array();
        foreach ($DistributionPoints as $DistributionPoint) {
            $field['id'] = $DistributionPoint->id;
            $field['name'] = $DistributionPoint->name;
            $field['state'] = $DistributionPoint->state;
            $field['unit'] = $DistributionPoint->creation_date;
            $field['address'] = $DistributionPoint->address;
            $filtered[] = $field;
        }
        return Response::json(['data' => $filtered], 200);
    }

    # RecipientDetails Functions
    public function recipientDetailsAddress($id)
    {
        $Addresses = RecipientDetaile::findOrFail($id)->Address;
        $field = array();
        $filtered = array();
        foreach ($Addresses as $address) {
            $field['id'] = $address->id;
            $field['country'] = $address->country;
            $field['city'] = $address->city;
            $field['neighborhood'] = $address->neighborhood;
            $filtered[] = $field;
        }
        return Response::json(['data' => $filtered], 200);
    }
    public function recipientDetailsDistributionPoint($id)
    {
        $DistributionPoints = RecipientDetaile::findOrFail($id)->DistributionPoint;
        $field = array();
        $filtered = array();
        foreach ($DistributionPoints as $DistributionPoint) {
            $field['id'] = $DistributionPoint->id;
            $field['name'] = $DistributionPoint->name;
            $field['state'] = $DistributionPoint->state;
            $field['unit'] = $DistributionPoint->creation_date;
            $field['address'] = $DistributionPoint->address;
            $filtered[] = $field;
        }
        return Response::json(['data' => $filtered], 200);
    }
    public function recipientDetailsRecipientsList($id)
    {
        $RecipientsLists = RecipientDetaile::findOrFail($id)->RecipientsList;
        $field = array();
        $filtered = array();
        foreach ($RecipientsLists as $RecipientsList) {
            $field['id'] = $RecipientsList->id;
            $field['name'] = $RecipientsList->name;
            $field['creationDate'] = $RecipientsList->creationDate;
            $field['state'] = $RecipientsList->state;
            $field['note'] = $RecipientsList->note;
            $filtered[] = $field;
        }
        return Response::json(['data' => $filtered], 200);
    }
}