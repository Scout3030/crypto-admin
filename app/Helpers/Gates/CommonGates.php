<?php

namespace App\Helpers\Gates;

use App\Models\User;
use Auth;
use Gate;

class CommonGates
{
    public static function register(): void
    {
        //Gates for Users table
        Gate::define('users.view', function (User $user) {
            return  $user->isSuperAdmin;
        });

        Gate::define('users.edit', function (User $user) {
            return $user->isSuperAdmin || Auth::user()->id === $user->id;
        });

        Gate::define('users.delete', function (User $user) {
            return $user->isSuperAdmin;
        });

        //Other Gates
    }
}
