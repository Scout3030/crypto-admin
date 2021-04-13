<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'doLogin'])
     ->middleware('guest')
     ->name('do.login');
