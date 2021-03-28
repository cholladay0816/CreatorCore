<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CashierWebhookController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ExploreController;
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
})->name('welcome');

Route::get('/explore', [ExploreController::class, 'index'])
->name('explore');

Route::get('/creator/{user:name}/{page?}', [\App\Http\Controllers\CreatorController::class, 'show'])
    ->name('creator.show');

Route::get('/attachments/{attachment}', [AttachmentController::class, 'show'])
    ->middleware('attachments.canview')
    ->name('attachments.show');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('/notifications', NotificationController::class, ['index'])
        ->names(['notifications.index']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('commissions')->group(function () {
        Route::middleware(['verified.payment'])->group(function () {
            Route::get('/new/{user}/{commissionpreset?}', [CommissionController::class, 'create'])
                ->name('commissions.create');
            Route::post('/new/{user}/{commissionpreset?}', [CommissionController::class, 'store'])
                ->name('commissions.store');
        });

        Route::get('/{commission}', [CommissionController::class, 'show'])
            ->middleware('commissions.canview')
            ->name('commissions.show');

        Route::put('/{commission}', [CommissionController::class, 'update'])
            ->middleware('commissions.canview')
            ->name('commissions.update');

        Route::delete('/{commission}', [CommissionController::class, 'destroy'])
            ->middleware('commissions.canview')
            ->name('commissions.destroy');

        Route::get('/', [CommissionController::class, 'commissions'])
            ->name('commissions.index');
    });
    Route::get('/orders', [CommissionController::class, 'orders'])
        ->name('commissions.orders');
});
