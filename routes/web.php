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
Route::get('/destinasi', [App\Http\Controllers\FrontendController::class, 'destinationIndex'])->name('destination.index');
Route::get('/destinasi/{slug}', [FrontendController::class, 'showDestination'])->name('destination.show');
Route::post('/destinasi/{id}/review', [FrontendController::class, 'storeReview'])->name('review.store');

Route::get('/umkm', [FrontendController::class, 'umkmIndex'])->name('umkm.index');
Route::get('/umkm/{slug}', [FrontendController::class, 'umkmShow'])->name('umkm.show');

Route::get('/paket-perjalanan', [FrontendController::class, 'itineraryIndex'])->name('itinerary.index');
Route::get('/paket-perjalanan/{slug}', [FrontendController::class, 'itineraryShow'])->name('itinerary.show');
Route::get('/berita', [FrontendController::class, 'newsIndex'])->name('news.index');
Route::get('/berita/{slug}', [FrontendController::class, 'newsShow'])->name('news.show');
// Route Baru: Galeri
Route::get('/galeri', [FrontendController::class, 'galleryIndex'])->name('gallery.index');
Route::get('/cerita', [FrontendController::class, 'storyIndex'])->name('story.index');
Route::get('/cerita/tulis', [FrontendController::class, 'storyCreate'])->name('story.create');
Route::post('/cerita/simpan', [FrontendController::class, 'storyStore'])->name('story.store');
Route::get('/cerita/{slug}', [FrontendController::class, 'storyShow'])->name('story.show');


Route::get('/smart-planner', [FrontendController::class, 'smartPlanner'])->name('planner.index');
Route::post('/smart-planner/generate', [FrontendController::class, 'generateSmartPlanner'])->name('planner.generate');
