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
      if (!$value) {
        return true;
      }

      $uppercase = boolval(preg_match('@[A-Z]@', $value));
      $lowercase = boolval(preg_match('@[a-z]@', $value));
      $number = boolval(preg_match('/\pN/', $value));
      $symbol = boolval(preg_match('/\p{Z}|\p{S}|\p{P}/', $value));
      $length = strlen($value) >= 8;

      return $uppercase && $lowercase && $number && $symbol && $length;
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
