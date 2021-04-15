<?php

use App\Http\Controllers\Users\UsersListController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'ajax',
    'as' => 'ajax.',
    'middleware' => 'auth',
], function () {

});
