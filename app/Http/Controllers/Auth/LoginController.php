<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\VerifyLoginTokenRequest;
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        session()->forget('otp-email');

        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $request->authenticate();
        $user = $request->user;

        if (!$user->is_active) {
            abort(403);
        }

        if (!$user->otp_required) {
            Auth::login($user);
            return redirect()->route('home');
        }

        session()->put('otp-email', $request->email);

        $token = rand(100000, 999999);

        $user->fill([
            'otp_token'    => $token,
            'token_status' => (string) User::ACTIVED_TOKEN,
        ])->save();

        try {
            Mail::to($user->email)->send(new SendOTPToken($token));
        } catch (\Throwable $th) {
            return back()->withErrors('An error occurred while sending the verification email.');
        }

        return redirect('/login/verify');
    }

    public function verifyLoginToken(VerifyLoginTokenRequest $request)
    {
        $request->user->fill([
            'otp_token'    => null,
            'token_status' => (string) User::INACTIVED_TOKEN,
        ])->save();

        Auth::loginUsingId($request->user->id);
        session()->forget('otp-email');

        if ($request->user->first_login == User::YES) {
            $request->user->fill([
                'first_login' => (string) User::NO,
            ])->save();

            return redirect()->route('user.change.password');
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function sendOTPCode()
    {
        $email = session('otp-email');
        $token = rand(100000, 999999);
        $user = User::whereEmail($email)->first();
        $user->fill([
            'otp_token'    => $token,
            'token_status' => (string) User::ACTIVED_TOKEN,
        ])->save();

        try {
            Mail::to($user->email)->send(new SendOTPToken($token));
        } catch (\Throwable $th) {
            return back()->withErrors('An error occurred while sending the verification email.');
        }

        return back()->with([
            'message' => [
                'class'   => 'success',
                'message' => ["Success", "We've send a new OTP code to your email inbox"],
            ],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
