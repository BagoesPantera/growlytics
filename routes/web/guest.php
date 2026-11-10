<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController;

Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
});