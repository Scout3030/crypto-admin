<?php

use App\Http\Controllers\Users\PermissionsController;
use App\Http\Controllers\Users\RolesController;
use App\Http\Controllers\Users\UsersListController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'ajax',
    'as' => 'ajax.',
    'middleware' => ['auth', 'segment'],
], function () {
    Route::delete('users/delete/{user}', [UsersListController::class, 'deleteAdmin'])
        ->middleware('can:user-management-side-menu')
        ->name('user.delete');
    Route::delete('users/delete', [UsersListController::class, 'delete'])
        ->middleware('can:role-delete')
        ->name('user.delete');
    Route::delete('roles/delete/{role}', [RolesController::class, 'delete'])
        ->middleware('can:role-delete')
         ->name('roles.delete');
    Route::post('permission/delete', [PermissionsController::class, 'delete'])
        ->middleware('can:role-delete')
         ->name('permission.delete');
    Route::post('merchant/delete', [PermissionsController::class, 'delete'])
        ->middleware('can:merchant-users-actions-button')
         ->name('merchant.delete');
    Route::post('users/otp-status', [UsersListController::class, 'changeOtpStatus'])->name('users.otp.status');
});
