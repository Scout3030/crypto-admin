<?php

use App\Http\Controllers\Users\UsersListController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'ajax',
    'as' => 'ajax.',
    'middleware' => 'auth',
], function () {
    Route::delete('users/delete/{user}', [UsersListController::class, 'deleteAdmin'])->name('user.delete');
    Route::post('users/otp-status', [UsersListController::class, 'changeOtpStatus'])->name('users.otp.status');
});
