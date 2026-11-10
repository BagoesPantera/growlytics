<?php

use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\ItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/search/items', [ItemController::class, 'search'])->name('search.items');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
    Route::get('/items/{item}/price-history', [ItemController::class, 'priceHistory'])->name('items.price-history');
    Route::get('/items/{item}/recent-worlds', [ItemController::class, 'recentWorlds'])->name('items.recent-worlds');
});
