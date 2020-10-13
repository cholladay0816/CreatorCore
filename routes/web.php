<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CommissionController;
use \App\Http\Controllers\AttachmentController;
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
});

Route::get('/attachment/{attachment}', [AttachmentController::class, 'view']);

Route::middleware(['auth:sanctum', 'verified'])->group( function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/commission/orders', [CommissionController::class, 'orders'])
        ->name('orders');
    Route::get('/commission', [CommissionController::class, 'index'])
        ->name('commissions');
    Route::get('/commission/{commission}', [CommissionController::class, 'view']);
    Route::put('/commission/{commission}', [CommissionController::class, 'update']);
    Route::delete('/commission/{commission}', [CommissionController::class, 'delete']);

    Route::get('/attachment/create/{commission}',[AttachmentController::class, 'create']);
    Route::post('/attachment/create/{commission}',[AttachmentController::class, 'store']);

    Route::delete('/attachment/{attachment}', [AttachmentController::class, 'delete']);
});
