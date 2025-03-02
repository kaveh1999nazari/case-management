<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
    Route::post('/request-otp', 'requestOtp');
    Route::post('/confirm-otp', 'confirmOtp');
});

Route::controller(\App\Http\Controllers\ShopController::class)->group(function () {
    Route::post('/shop/register', 'register');
    Route::post('/shop/login', 'login');
});


