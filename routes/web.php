<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Session;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('switch.lang');
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/destinasi/{slug}', [FrontendController::class, 'showDestination'])->name('destination.show');
Route::post('/destinasi/{id}/review', [FrontendController::class, 'storeReview'])->name('review.store');

Route::get('/umkm', [FrontendController::class, 'umkmIndex'])->name('umkm.index');
Route::get('/umkm/{slug}', [FrontendController::class, 'umkmShow'])->name('umkm.show');

Route::get('/paket-perjalanan', [FrontendController::class, 'itineraryIndex'])->name('itinerary.index');
Route::get('/paket-perjalanan/{slug}', [FrontendController::class, 'itineraryShow'])->name('itinerary.show');

// Route Baru: Galeri
Route::get('/galeri', [FrontendController::class, 'galleryIndex'])->name('gallery.index');
