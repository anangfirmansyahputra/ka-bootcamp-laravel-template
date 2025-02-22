<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name("dashboard");
});

Route::get('login',  function () {
    return view('login.index');
})->name('login');
