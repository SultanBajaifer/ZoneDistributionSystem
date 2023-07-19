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
    'middleware' => 'auth:api'
], function () {

    // Route::get('complaints', function () {
//     return Complaint::all();
// });
// Route::get('complaints/{$id}', function ($id) {
//     return Complaint::find($id);
// });


    // Route::get(
    //     'users/{id}/distributionPoints',
    //     'RelationshipsController@userDistributionPoints'
    // );
    // Route::get(
    //     'users/{id}/complaints',
    //     'RelationshipsController@userComplaints'
    // );
    // Route::get(
    //     'users/{id}/address',
    //     'RelationshipsController@userAddress'
    // );
    // Route::get(
    //     'packages/{id}/items',
    //     'RelationshipsController@packageItems'
    // );
    // Route::get(
    //     'items/{id}/package',
    //     'RelationshipsController@itemPackage'
    // );

    // Route::get(
    //     'recipientsList/{id}/distributionPoints',
    //     'RelationshipsController@recupientListDistributionPoints'
    // );
    // Route::get(
    //     'recipientsList/{id}/distributionRecords',
    //     'RelationshipsController@recupientListDistributionRecords'
    // );
    // Route::get(
    //     'recipientDetails/{id}/address',
    //     'RelationshipsController@recipientDetailsAddress'
    // );
    // Route::get(
    //     'recipientDetails/{id}/distributionPoint',
    //     'RelationshipsController@recipientDetailsDistributionPoint'
    // );
    // Route::get(
    //     'recipientDetails/{id}/recipientsList',
    //     'RelationshipsController@recipientDetailsRecipientsList'
    // );

    Route::apiResource('users', 'Api\CenterController')->only([
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
    Route::get('search', 'api\BaseController@querySearch');
    Route::get('home', 'api\BaseController@home');
    Route::get('download/{id}', 'api\DistributerController@downloadList');
    Route::post('upload', 'api\DistributerController@UploadList');
    Route::post('sendList/{id}', 'api\CenterController@SendList');
    Route::put('updatePassword/{id}', 'api\CenterController@updatePassword');
    Route::post('complexStore', 'api\RecipientsListController@complexStore');
    Route::get(
        'list/{id}/records',
        'api\RecipientsListController@recipientListRecipients'
    );
    Route::apiResource('items', api\ItemController::class);
    Route::apiResource('addresses', api\AddressController::class);
    Route::apiResource('packages', api\PackageController::class);
    Route::apiResource('distributionPoint', api\DistributionPointController::class);
    Route::apiResource('recipientDetailes', api\RecipientDetaileController::class);
    Route::apiResource('recipientsList', api\RecipientsListController::class);
    Route::apiResource('distributionRecord', api\DistributionRecordController::class)->only([
        'index',
        'show'
    ]);
    // Route::put('users/{$id}', function ($id, Request $request) {
//     $user = User::find($id);
//     $user->update($request->all());
//     return $user;
// })->name('edit');

    #################### Search Route ########################





});
##  Login Routse    ###
Route::any('login', 'api\UserController@login')->name('login');