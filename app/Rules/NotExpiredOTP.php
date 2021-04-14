<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class NotExpiredOTP implements Rule
{
    private $user;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $email = session()->get('otp-email');
        $this->user = User::whereEmail($email)->first();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->user->token_status != (string) User::ACTIVED_TOKEN) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The OTP code has expired.';
    }
}
