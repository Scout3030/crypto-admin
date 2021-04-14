<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Rules\StrengthPassword;

class UserController extends Controller
{
    public function updatePassword(){
        $this->validate(request(), [
			'password' => ['required', 'confirmed', new StrengthPassword]
		]);

		$user = auth()->user();
		$user->password = bcrypt(request('password'));
		$user->save();
        return redirect(RouteServiceProvider::HOME); 
    }
}
