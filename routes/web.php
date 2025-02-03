<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name("dashboard");
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});


Route::get('login',  [\App\Http\Controllers\AuthController::class, 'index'])->name('login')->middleware("guest");
Route::post('login',  [\App\Http\Controllers\AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post("logout",  [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth');
