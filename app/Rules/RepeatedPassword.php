<?php

namespace App\Rules;

use App\Helpers\Services\PasswordService;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class RepeatedPassword implements Rule
{
    private $user;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = auth()->user();
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
        $rememberedPasswords = $this->user->properties['passwords'] ?? [];
        $newPassword = $value;
        foreach ($rememberedPasswords as $oldPassword) {
            if (Hash::check($newPassword, $oldPassword)) {
                return false;
            }
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
        return 'Don\'t use an old password';
    }
}
