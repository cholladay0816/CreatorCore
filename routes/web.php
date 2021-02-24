<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CashierWebhookController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\NotificationController;
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

Route::post(
    '/stripe/webhook',
    [CashierWebhookController::class, 'handleWebhook']
);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

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

    Route::prefix('commissions')->group(function () {
        Route::middleware(['verified.account'])->group(function () {
            Route::get('/new/{user}/{commissionpreset?}', [CommissionController::class, 'create'])
                ->name('commissions.create');
            Route::post('/new/{user}/{commissionpreset?}', [CommissionController::class, 'store'])
                ->name('commissions.store');
        });

        Route::get('/{commission}', [CommissionController::class, 'show'])
            ->name('commissions.show');

        Route::put('/{commission}', [CommissionController::class, 'update'])
            ->name('commissions.update');

        Route::delete('/{commission}', [CommissionController::class, 'destroy'])
            ->name('commissions.destroy');

        Route::get('/', [CommissionController::class, 'commissions'])
            ->name('commissions.index');
    });
    Route::get('/orders', [CommissionController::class, 'orders'])
        ->name('commissions.orders');
});
