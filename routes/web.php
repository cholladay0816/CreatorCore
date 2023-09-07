<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CashierWebhookController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CommissionPresetController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OnboardingController;
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

Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])
->name('sitemap');

Route::get('thank-you', function () {
    return view('thanks');
});

Route::get('/find-a-gig', [ExploreController::class, 'commissionSearch'])
    ->name('find-a-gig');

Route::get('/explore', [ExploreController::class, 'index'])
->name('explore');

Route::get('/creator/{user:name}/{page?}', [CreatorController::class, 'show'])
    ->name('creator.show');

Route::get('/gallery/{gallery}', [\App\Http\Controllers\GalleryController::class, 'show'])
    ->name('gallery.show');

Route::get('/attachments/{attachment}', [AttachmentController::class, 'show'])
    ->middleware('attachments.canview')
    ->name('attachments.show');

Route::get('/reviews', [\App\Http\Controllers\ReviewController::class, 'index'])
    ->name('reviews.index');

Route::get('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'show'])
    ->name('reviews.show');

Route::get('/reviews/{review}/edit', [\App\Http\Controllers\ReviewController::class, 'edit'])
    ->name('reviews.edit');

Route::put('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'update'])
    ->name('reviews.update');

Route::delete('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])
    ->name('reviews.destroy');

Route::post('auth/google', [\App\Http\Controllers\GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [\App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/onboarding', [OnboardingController::class, 'index'])
        ->name('onboarding');

    Route::get('/reviews/create/{commission}', [\App\Http\Controllers\ReviewController::class, 'create'])
        ->name('reviews.create');
    Route::post('/reviews/create/{commission}', [\App\Http\Controllers\ReviewController::class, 'store'])
        ->name('reviews.store');
    Route::get('/ratings/create/{review}', [\App\Http\Controllers\RatingController::class, 'create'])
        ->name('ratings.create');
    Route::post('/ratings/create/{review}', [\App\Http\Controllers\RatingController::class, 'store'])
        ->name('ratings.store');

    Route::resource(
        'tickets',
        \App\Http\Controllers\TicketController::class,
        ['index', 'create', 'store', 'show']
    );

    Route::post('/gallery', [\App\Http\Controllers\GalleryController::class, 'store'])
        ->name('gallery.store');

    Route::delete('/gallery/{gallery}', [\App\Http\Controllers\GalleryController::class, 'destroy'])
        ->name('gallery.destroy');

    Route::resource('/commissionpresets', CommissionPresetController::class)
    ->parameter('commissionpresets', 'commissionPreset');

    Route::resource('/notifications', NotificationController::class, ['index'])
        ->names(['notifications.index']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware(\App\Http\Middleware\OnboardingMiddleware::class);

    Route::prefix('commissions')->group(function () {
        Route::get('/new/{user}/{commissionPreset?}', [CommissionController::class, 'create'])
            ->name('commissions.create');
        Route::post('/new/{user}/{commissionPreset?}', [CommissionController::class, 'store'])
            ->name('commissions.store');
        Route::get('/{commission}/checkout', [CommissionController::class, 'checkout'])
            ->middleware('commissions.canview')
            ->name('commissions.checkout');
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
