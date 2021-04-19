<?php

namespace App\Http\Requests\Auth;

use App\Helpers\Services\SegmentService;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => [
                'required',
                'string',
                'email',
                Rule::exists('users', 'email'),
            ],
            'password' => 'required|string',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::validate($this->only('email', 'password'))) {
            $this->tooManyAttemtps();

            app(SegmentService::class)
                ->init()
                ->identify()
                ->event('Incorrect login data', [
                    'email' => $this->input('email'),
                ]);

            throw ValidationException::withMessages([
                'email'    => __('auth.failed'),
                'password' => __('auth.failed'),
                'attempts' => __('auth.attempts', [
                    'attempts' => config('auth.max_attempt') - $this->user->login_attempts + 1
                ]),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        $attempts = $this->user->login_attempts;

        if ($attempts < config('auth.max_attempt')) {
            return;
        }

        if (!$this->user->blocked_at) {
            $this->user->blocked_at = Carbon::now();
            $this->user->save();

            event(new Lockout($this));
        }

        $blocked = $this->user->blocked_at->addMinutes(config('auth.block_time'));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'minutes' => Carbon::now()->diffInMinutes($blocked),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')) . '|' . $this->ip();
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $email = $this->email;
        $user = User::whereEmail($email)->first();
        $this->offsetSet('user', $user);
    }

    private function tooManyAttemtps()
    {
        $this->user->increment('login_attempts');
    }

}
