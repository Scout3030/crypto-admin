<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\RolesController;
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

require __DIR__ . '/auth.php';
require __DIR__ . '/ajax.php';

Route::group([
    'middleware' => ['auth', 'active', 'segment'],
], function () {

    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('home');

    Route::view('/change/password', 'user.change-password')
         ->name('user.change.password');
    Route::put('/change/password', [UserController::class, 'updatePassword'])
         ->name('user.update.password');

    //Users
    Route::group([
        'middleware' => 'can:user-management-side-menu',
        'prefix' => 'users',
    ], function () {
        Route::get('list', UsersListController::class)->name('users.list');
        Route::get('edit/{user?}', [UsersListController::class, 'editAdmin'])->name('user.edit');
        Route::get('edit', [UsersListController::class, 'editAdmin'])->name('user.create');
        Route::post('store/{user?}', [UsersListController::class, 'storeAdmin'])->name('user.store');
    });

    //Roles
    Route::group([
        'prefix' => 'roles',
        'as'     => 'roles.',
    ], function () {
        Route::get('list', [RolesController::class, 'index'])->name('list');
        Route::get('view/{role}', [RolesController::class, 'show'])->name('view');
        Route::get('edit/{role?}', [RolesController::class, 'edit'])->name('edit');
        Route::get('edit/', [RolesController::class, 'edit'])->name('create');
        Route::post('store/{role?}', [RolesController::class, 'store'])->name('store');
    });

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
