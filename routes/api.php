<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\API\AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware("auth:sanctum")->group(function () {
    Route::resource("categories", \App\Http\Controllers\API\CategoryController::class)->only([
        'store',
        'update',
        'destroy'
    ]);
});

Route::resource("categories", \App\Http\Controllers\API\CategoryController::class)->only(['index', 'show']);
