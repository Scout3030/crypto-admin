<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Users\UsersListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'auth',
], function() {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('home');

    Route::view('/change/password', 'user.change-password')
        ->name('user.change.password');
    Route::put('/change/password', [UserController::class, 'updatePassword'])
        ->name('user.update.password');

    //Demo
    Route::get('users/list', UsersListController::class)->name('users.list');
});
