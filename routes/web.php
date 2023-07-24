<?php

use App\Models\Complaint;
use App\Http\Resources\Complaint as ComplaintResource;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('complaint', function () {
    return view('complaint');
});
Route::get('users', function () {
    return view('create_user');
});
Route::get('complaintList', function () {
    $Complaints = Complaint::all();

    return view('complaintList', ['Complaints' => $Complaints]);
});
Route::get('thinksForComplaint', function () {
    return view('thinksForComplaint');
})->name('thinksForComplaint');

Route::get('responseTocomplaint/{id}', function ($id) {
    $complaint = Complaint::findOrFail($id);
    return view('responseToComplaint', ['request' => $complaint]);
})->name('response');