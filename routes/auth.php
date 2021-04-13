<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'doLogin'])
     ->middleware('guest')
     ->name('do.login');

Route::view('/login/verify', 'auth.login_verify')
    ->middleware('otp.token');
Route::post('/login/verify', [LoginController::class, 'verifyLoginToken'])
    ->middleware('otp.token')
    ->name('auth.login.verify');
