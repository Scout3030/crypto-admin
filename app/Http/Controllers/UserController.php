<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPasswordRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updatePassword(NewPasswordRequest $request){

		$user = auth()->user();

        $hash = Hash::make($request->password);

        $rememberedPasswords = $user->properties['passwords'] ?? [];

        if (count($rememberedPasswords) >= 3) {
            array_shift($rememberedPasswords);
        }

        $rememberedPasswords[] = $hash;

        $properties = [
            'passwords' => $rememberedPasswords,
        ];

        $user->password = bcrypt($request->password);
        $user->properties = $properties;
        $user->save();

        return redirect(RouteServiceProvider::HOME);
    }

    public function profile()
    {
        return view('user.profile');
    }
}
