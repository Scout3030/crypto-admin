<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'doLogin'])
     ->middleware('guest')
     ->name('do.login');

Route::group(['middleware' => 'otp.token'], function () {
    Route::view('/login/verify', 'auth.login_verify');
    Route::post('/login/verify', [LoginController::class, 'verifyLoginToken'])
        ->name('auth.login.verify');
    Route::post('/send/opt/code', [LoginController::class, 'sendOTPCode'])
        ->name('auth.send.otp.code');
});
