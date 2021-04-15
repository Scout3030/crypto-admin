<?php

namespace App\Http\Requests\Users;

use App\Rules\StrengthPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('users.edit');
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
            'email' => ['required', Rule::unique('users')->ignore($this->id)],
            'password' => ['required_without:id', new StrengthPassword(), 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'password.required_without' => 'A password is required when user creating.',
        ];
    }
}
