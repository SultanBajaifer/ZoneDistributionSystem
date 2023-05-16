<?php

use App\Http\Controllers\DistributionPointController;
use App\Http\Controllers\RelationshipsController;
use App\Http\Controllers\api\UserController;
use App\Models\Complaint;
use App\Models\DistributionPoint;
use App\Models\User;
use App\Models\RecipientDetaile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    // 'middleware' => 'auth.basic'
], function () {

    // Route::get('complaints', function () {
//     return Complaint::all();
// });
// Route::get('complaints/{$id}', function ($id) {
//     return Complaint::find($id);
// });


    Route::get(
        'users/{id}/DistributionPoints',
        'RelationshipsController@userDistributionPoints'
    );
    Route::get(
        'users/{id}/Complaints',
        'RelationshipsController@userComplaints'
    );
    Route::get(
        'users/{id}/Address',
        'RelationshipsController@userAddress'
    );
    Route::get(
        'packages/{id}/Items',
        'RelationshipsController@packageItems'
    );
    Route::get(
        'Item/{id}/Package',
        'RelationshipsController@itemPackage'
    );
    Route::get(
        'RecipientList/{id}/Recipient',
        'RelationshipsController@recupientListRecipients'
    );
    Route::get(
        'RecipientList/{id}/DistributionPoints',
        'RelationshipsController@recupientListDistributionPoints'
    );
    Route::get(
        'RecipientDetails/{id}/Address',
        'RelationshipsController@recipientDetailsAddress'
    );
    Route::get(
        'RecipientDetails/{id}/DistributionPoint',
        'RelationshipsController@recipientDetailsDistributionPoint'
    );
    Route::get(
        'RecipientDetails/{id}/RecipientsList',
        'RelationshipsController@recipientDetailsRecipientsList'
    );
    Route::apiResource('users', 'Api\UserController')->only([
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ]);
    // Route::apiResource('users', UserController::class);
    Route::apiResource('complaints', api\ComplaintController::class)->only([
        'index',
        'show',
        'store'
    ]);
    Route::apiResource('items', api\ItemController::class);
    Route::apiResource('packages', api\PackageController::class);
    Route::apiResource('distributionPoint', api\DistributionPointController::class);
    Route::apiResource('RecipientDetailes', api\RecipientDetaileController::class);
    Route::apiResource('RecipientList', api\RecipientsListController::class);
    Route::apiResource('DistributionRecord', api\DistributionRecordController::class);
    // Route::put('users/{$id}', function ($id, Request $request) {
//     $user = User::find($id);
//     $user->update($request->all());
//     return $user;
// })->name('edit');



    Route::get('login', 'api\LoginController@login');
});
##  Login Routse    ###
