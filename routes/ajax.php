<?php

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
    Route::delete('roles/delete/{role}', [RolesController::class, 'delete'])
        ->middleware('can:role-delete')
         ->name('roles.delete');
    Route::post('users/otp-status', [UsersListController::class, 'changeOtpStatus'])->name('users.otp.status');
});
