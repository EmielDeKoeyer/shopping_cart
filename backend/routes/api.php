<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::controller(ProductController::class)->prefix('products')->group(function (){
    Route::get('/', 'listProducts');
    Route::get('/{id}', 'getProduct');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout');
    });

    Route::controller(CartController::class)->prefix('cart')->group(function (){
        Route::get('/', 'listCart');
        Route::post('/update', 'updateCart');
    });
});