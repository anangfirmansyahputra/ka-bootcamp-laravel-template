<?php

use App\Http\Controllers\API\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/webhook', [OrderController::class, 'webhookPayment']);

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
    Route::post('/orders', [OrderController::class, 'createOrder']);
    Route::get('/orders', [OrderController::class, 'getOrders']);
    Route::delete('/orders/{id}', [OrderController::class, 'deleteOrder']);
    Route::post('/orders/{id}/pay', [OrderController::class, 'payOrder']);
});

Route::resource("categories", \App\Http\Controllers\API\CategoryController::class)->only(['index', 'show']);
