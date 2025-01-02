<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AuthenticateLoginRequest
 * @package App\Http\Requests\Auth
 * @property string $email
 * @property string $password
 */
class AuthenticateLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('validation.email.required'),
            'email.email' => __('validation.email.email'),
            'password.required' => __('validation.password.required'),
        ];
    }

    public function passedValidation(): void
    {
        $this->replace([
            'email' => strtolower($this->input('email')),
            'password' => $this->input('password'),
        ]);
    }
}
