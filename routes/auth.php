<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])
  ->middleware('guest')
  ->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])
  ->middleware(['guest'])
  ->name('do.login');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])
  ->name('auth.showForgotPasswordForm');
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetEmail'])
  ->name('auth.sendPasswordResetEmail');
Route::get('/reset-password', [AuthController::class, 'showPasswordResetForm'])
  ->name('auth.showPasswordResetForm');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])
  ->name('auth.resetPassword');

Route::group(['middleware' => 'otp.token'], function () {
  Route::view('/login/verify', 'auth.login_verify');
  Route::post('/login/verify', [AuthController::class, 'verifyLoginToken'])
    ->name('auth.login.verify');
  Route::post('/send/opt/code', [AuthController::class, 'sendOTPCode'])
    ->name('auth.send.otp.code');
});
