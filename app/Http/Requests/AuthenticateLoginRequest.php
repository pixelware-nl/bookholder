<?php

namespace App\Http\Requests;

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
            'remember_me' => ['required', 'boolean']
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
