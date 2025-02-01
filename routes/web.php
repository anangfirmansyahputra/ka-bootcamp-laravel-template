<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware('auth')->group(function () {
    Route::get('/', DashboardController::class);
});


Route::get('login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login')->middleware("guest");
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post("logout", action: [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth');
