<?php

namespace App\Http\Requests;

use App\Rules\RepeatedPassword;
use App\Rules\StrengthPassword;
use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
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
            'password' => [
                'required',
                'min:8',
                'confirmed',
                new StrengthPassword(),
                new RepeatedPassword()
            ]
        ];
    }
}
