<?php

use App\Http\Controllers\Auth\LoginController;
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
require __DIR__.'/ajax.php';

Route::group([
    'middleware' => 'auth',
], function() {

    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('home');

    Route::view('/change/password', 'user.change-password')
        ->name('user.change.password');
    Route::put('/change/password', [UserController::class, 'updatePassword'])
        ->name('user.update.password');


    Route::get('users/list', UsersListController::class)->name('users.list');
    Route::get('users/edit/{user?}', [UsersListController::class, 'editMerchant'])->name('user.edit');
    Route::get('users/edit', [UsersListController::class, 'editMerchant'])->name('user.create');
    Route::post('users/store/{user?}', [UsersListController::class, 'storeAdmin'])->name('user.store');
    Route::delete('users/delete/{user}', [UsersListController::class, 'deleteMerchant'])->name('user.delete');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
