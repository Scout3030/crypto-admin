<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;

class UsersListController
{
    public function __invoke(Request $request)
    {
        if ($request->user()->cannot('users.view')) {
            abort(403);
        }

        //Demo
        return User::all();
    }
}
