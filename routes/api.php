<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
    Route::post('/request-otp', 'requestOtp');
    Route::post('/confirm-otp', 'confirmOtp');
});
