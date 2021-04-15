<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPasswordRequest;
use App\Providers\RouteServiceProvider;

class UserController extends Controller
{
    public function updatePassword(NewPasswordRequest $request){
		$user = auth()->user();
		$user->password = bcrypt($request->password);
		$user->save();
        return redirect(RouteServiceProvider::HOME);
    }
}
