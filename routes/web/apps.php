<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apps\DashboardController;


Route::prefix('app')->name('app.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});