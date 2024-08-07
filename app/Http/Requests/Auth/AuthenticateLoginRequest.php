<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

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

    public function passedValidation(): void
    {
        $this->replace([
            'email' => strtolower($this->input('email')),
            'password' => $this->input('password'),
        ]);
    }
}
