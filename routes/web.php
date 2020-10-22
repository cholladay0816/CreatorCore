<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CommissionController;
use \App\Http\Controllers\AttachmentController;
use \App\Http\Controllers\CreatorController;
use \App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhookController;


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

Route::middleware(['auth:sanctum', 'verified'])->group( function() {
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/payment/new', [PaymentController::class, 'new']);
    Route::post('/payment/new', [PaymentController::class, 'store']);

    Route::get('/payment/{commission}', [PaymentController::class, 'show']);
    Route::post('/payment/{commission}', [PaymentController::class, 'pay']);

    Route::get('/commission/orders', [CommissionController::class, 'orders'])
        ->name('orders');
    Route::get('/commission/timeline', [CommissionController::class, 'timeline'])
        ->name('timeline');
    Route::get('/commission', [CommissionController::class, 'index'])
        ->name('commissions');
    Route::get('/commission/{commission}', [CommissionController::class, 'view']);
    Route::put('/commission/{commission}', [CommissionController::class, 'update']);
    Route::delete('/commission/{commission}', [CommissionController::class, 'delete']);

    Route::get('/attachment/create/{commission}',[AttachmentController::class, 'create']);
    Route::post('/attachment/create/{commission}',[AttachmentController::class, 'store']);

    Route::delete('/attachment/{attachment}', [AttachmentController::class, 'delete']);
});
Route::get('/{creator}', [CreatorController::class, 'index']);
Route::get('/{creator}/{page}', [CreatorController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
