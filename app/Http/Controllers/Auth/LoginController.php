<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\SendOTPToken;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        session()->put('otp-email', $request->email);
        $user = User::whereEmail($request->email)->first();

        if (Hash::check($request->password, $user->password)) {
            $token = rand(100000,999999);

            $user->fill([
                'otp_token' => $token,
                'token_status' => (string) User::ACTIVED_TOKEN
            ])->save();

            try {
                Mail::to($user->email)->send(new SendOTPToken($token));
            } catch (\Throwable $th) {
                return back()->withErrors('An error occurred while sending the verification email.');
            }

            return redirect('/login/verify');
        }
        return back()->withErrors('Incorrect credentials.');
    }

    public function verifyLoginToken(Request $request)
    {
        $otp_token = $request->otp_token;
        $email = session()->get('otp-email');
        $user = User::whereEmail($email)->first();
        if($user->otp_token == $otp_token && $user->token_status == (string) User::ACTIVED_TOKEN){

            $user->fill([
                'otp_token' => null,
                'token_status' => (string) User::INACTIVED_TOKEN
            ])->save();

            Auth::loginUsingId($user->id);
            session()->forget('otp-email');

            if($user->first_login == User::YES){

                $user->fill([
                    'first_login' => (string) User::NO
                ])->save();
                return redirect()->route('user.change.password');
            }

            return redirect(RouteServiceProvider::HOME);
        }
        return back()->withErrors('Invalid OTP code');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function username()
    {
        return 'email';
    }

    public function sendOTPCode(){
        $email = session()->get('otp-email');
        $token = rand(100000,999999);
        $user = User::whereEmail($email)->first();
        $user->fill([
            'otp_token' => $token,
            'token_status' => (string) User::ACTIVED_TOKEN
        ])->save();

        try {
            Mail::to($user->email)->send(new SendOTPToken($token));
        } catch (\Throwable $th) {
            return back()->withErrors('An error occurred while sending the verification email.');
        }

        return back()->with(['message' => [
                'class' => 'success',
                'message' => ["Success", "We've send a new OTP code to your email inbox"]
            ]
        ]);
    }
}
