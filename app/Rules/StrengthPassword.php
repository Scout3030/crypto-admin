<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrengthPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if ( ! $value) {
        	return true;
        }

	    $uppercase          = preg_match('@[A-Z]@', $value);
	    $lowercase          = preg_match('@[a-z]@', $value);
	    $number             = preg_match('@[0-9]@', $value);
        $symbol             = preg_match('@[*/?¿#$%&()\@]@', $value);

        $success = true;

        if ( ! $uppercase || ! $lowercase || ! $number || !$symbol) {
        	$success = false;
        }

        return $success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Password must contains at least one capital letter, one alphanumeric and one symbol.';
    }
}
