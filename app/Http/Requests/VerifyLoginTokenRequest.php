<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\NotExpiredOTP;
use App\Rules\ValidOTP;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyLoginTokenRequest extends FormRequest
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
            'otp_token' => [
                'required',
                'min:6',
                'max:6',
                new NotExpiredOTP(),
                new ValidOTP(),
            ],
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $email = session('otp-email');
        $user = User::whereEmail($email)->first();
        $this->offsetSet('user', $user);
    }
}
