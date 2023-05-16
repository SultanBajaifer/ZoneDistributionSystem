<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Response;
use App\Http\Resources\Package as PackageResource;


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $Package = PackageResource::collection(Package::all());
        return $Package->response()->setStatusCode(200, "Packages Returned Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $Package = new PackageResource(Package::create($request->all()));
        return $Package->response()->setStatusCode(200, "Package Created Succefully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $Package = new PackageResource(Package::findOrFail($id));
        return $Package->response()->setStatusCode(200, "Package Returned Succefully")->
            header("Addestionl Header", "true");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $Package
     */
    public function edit(Package $Package)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update($id, Request $request)
    {
        $Package = new PackageResource(Package::findOrFail($id));
        $Package->update($request->all());
        return $Package->response()->setStatusCode(200, "Package Updated Succefully")->
            header("Addestionl Header", "true");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $Package = Package::findOrFail($id);
        $Package->delete();
        return Response::json(
            [
                $Package
            ],
            202
        );
    }
}