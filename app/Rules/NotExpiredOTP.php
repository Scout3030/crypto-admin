<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class NotExpiredOTP implements Rule
{
    private User $user;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $email = session('otp-email');
        $this->user = User::whereEmail($email)->first();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->user->token_status == (string) User::ACTIVED_TOKEN;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The OTP code has expired.';
    }
}
