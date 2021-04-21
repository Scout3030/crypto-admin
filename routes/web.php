<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Users\PermissionsController;
use App\Http\Controllers\Users\RolesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Users\UsersListController;
use App\Http\Controllers\ToolController;

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

Route::get('/tool/clean-up', [ToolController::class, 'cleanAllTables'])->name('clean.up');

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
    Route::view('/new/password', 'user.new-password')
        ->name('user.new.password');

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

    //Permissions
    Route::group([
        'prefix' => 'permissions',
        'as' => 'permissions.',
    ], function () {
        Route::get('list', [PermissionsController::class, 'index'])->name('index');
        Route::get('list/{permission?}', [PermissionsController::class, 'edit'])->name('edit');
        Route::get('list/create', [PermissionsController::class, 'edit'])->name('create');
    });

    //Notifications
    Route::group([
        'prefix' => 'notifications',
        'as' => 'notifications.',
    ], function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
    });

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile/edit', [UserController::class, 'profile'])->name('profile.edit');
});
