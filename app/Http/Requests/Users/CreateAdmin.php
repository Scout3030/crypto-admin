<?php

namespace App\Http\Requests\Users;

use App\Rules\StrengthPassword;
use Illuminate\Foundation\Http\FormRequest;

class CreateAdmin extends FormRequest
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
            'first_name' => 'required',
            'last_name'  => 'required',
            'email' => 'required',
            'password' => ['required_without:id', new StrengthPassword()]
        ];
    }

    public function messages()
    {
        return [
            'password.required_without' => 'A password is required when user creating.',
        ];
    }
}
