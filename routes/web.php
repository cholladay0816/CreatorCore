<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\SourceController;
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
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('source/new', [SourceController::class, 'create'])
        ->name('source.create');
    Route::post('source/new', [SourceController::class, 'store'])
        ->name('source.store');

    Route::post('/attachments/new/{commission}', [AttachmentController::class, 'store'])
        ->name('attachments.store');

    Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])
        ->name('attachments.destroy');

    Route::middleware(['paymentmethod'])->group(function () {
        Route::get('/commissions/new/{user}/{commissionpreset?}', [CommissionController::class, 'create'])
            ->name('commissions.create');
        Route::post('/commissions/new/{user}/{commissionpreset?}', [CommissionController::class, 'store'])
            ->name('commissions.store');
    });

    Route::get('/commissions/{commission}', [CommissionController::class, 'show'])
        ->name('commissions.show');

    Route::put('/commissions/{commission}', [CommissionController::class, 'update'])
        ->name('commissions.update');

    Route::delete('/commissions/{commission}', [CommissionController::class, 'destroy'])
        ->name('commissions.destroy');

    Route::get('/commissions', [CommissionController::class, 'commissions'])
        ->name('commissions.index');
    Route::get('/orders', [CommissionController::class, 'orders'])
        ->name('commissions.orders');

    Route::get('/bankaccount', [BankAccountController::class, 'index'])
        ->name('bankaccount.list');
    Route::get('/bankaccount/create', [BankAccountController::class, 'create'])
        ->name('bankaccount.create');
    Route::post('/bankaccount/create', [BankAccountController::class, 'store'])
        ->name('bankaccount.store');

    Route::get('/bankaccount/{source}/verify', [BankAccountController::class, 'verify'])
        ->name('bankaccount.verify');
    Route::put('/bankaccount/{source}/verify', [BankAccountController::class, 'sendVerification'])
        ->name('bankaccount.sendVerification');


    Route::get('/bankaccount/{source}', [BankAccountController::class, 'edit'])
        ->name('bankaccount.edit');

    Route::put('/bankaccount/{source}', [BankAccountController::class, 'update'])
        ->name('bankaccount.update');
});
