<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware('auth')->group(function () {
  Route::get('/', DashboardController::class)->name('dashboard');
  Route::resource('categories', CategoryController::class);
  Route::resource('products', ProductController::class);
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/login', [AuthController::class, 'index'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
