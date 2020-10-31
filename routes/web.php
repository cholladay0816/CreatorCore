<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CommissionController;
use \App\Http\Controllers\AttachmentController;
use \App\Http\Controllers\CreatorController;
use \App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\CommissionPresetController;

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
Route::post(
    'stripe/webhook',
    [WebhookController::class, 'handleWebhook']
);

Route::get('/attachment/{attachment}', [AttachmentController::class, 'view']);
Route::get('/gallery/{gallery}', [GalleryController::class, 'view']);

Route::middleware(['auth:sanctum', 'verified'])->group( function() {

    //Dashboard
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    //Attachment Routes
    Route::get('/attachment/create/{commission}',[AttachmentController::class, 'create']);
    Route::post('/attachment/create/{commission}',[AttachmentController::class, 'store']);
    Route::delete('/attachment/{attachment}', [AttachmentController::class, 'delete']);


    //Gallery Routes
    Route::post('/gallery/upload',[GalleryController::class, 'store']);
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'delete']);


    //Creator Routes
    Route::get('/creator/new',[CreatorController::class, 'create']);
    Route::post('/creator/new',[CreatorController::class, 'store']);
    Route::get('/creator/edit/{creator}',[CreatorController::class, 'edit']);
    Route::put('/creator/edit/{creator}',[CreatorController::class, 'update']);
    Route::delete('/creator/delete/{creator}',[CreatorController::class, 'delete']);


    //Payment Routes
    Route::get('/payment/new', [PaymentController::class, 'new']);
    Route::post('/payment/new', [PaymentController::class, 'store']);
    Route::get('/payment/{commission}', [PaymentController::class, 'show']);
    Route::post('/payment/{commission}', [PaymentController::class, 'pay']);

    Route::get('/transactions', [PaymentController::class, 'history']);


    //Commission Routes
    Route::get('/commission/orders', [CommissionController::class, 'orders'])
        ->name('orders');
    Route::get('/commission/timeline', [CommissionController::class, 'timeline'])
        ->name('timeline');
    Route::get('/commission', [CommissionController::class, 'index'])
        ->name('commissions');
    Route::get('/commission/create/{title}', [CommissionController::class, 'create']);
    Route::post('/commission/create/{title}', [CommissionController::class, 'store']);
    Route::get('/commission/{commission}', [CommissionController::class, 'view']);
    Route::put('/commission/{commission}', [CommissionController::class, 'update']);
    Route::delete('/commission/{commission}', [CommissionController::class, 'delete']);


    //Commission Preset Routes
    Route::get('/commissionpreset/new', [CommissionPresetController::class, 'create']);
    Route::post('/commissionpreset/new', [CommissionPresetController::class, 'store']);
    Route::get('/commissionpreset/{commissionPreset}', [CommissionPresetController::class, 'edit']);
    Route::put('/commissionpreset/{commissionPreset}', [CommissionPresetController::class, 'update']);
    Route::delete('/commissionpreset/{commissionPreset}', [CommissionPresetController::class, 'delete']);


});


Route::get('/testindex', function () {
    return view('index-sample');
});
Route::get('/explore', function () {
    return view('index-sample');
})->name('explore');

//Creator Routes
Route::get('/{creator}', [CreatorController::class, 'index']);
Route::get('/{creator}/{page}', [CreatorController::class, 'index']);



Route::get('/', function () {
    return view('index-sample');
})->middleware('guest');

