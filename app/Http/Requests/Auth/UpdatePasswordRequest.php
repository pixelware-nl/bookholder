<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePasswordRequest
 * @package App\Http\Requests\Auth
 * @property string $token
 * @property string $email
 * @property string $password
 */
class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'Token is verplicht',
            'email.required' => 'E-mail is verplicht',
            'email.email' => 'E-mail is ongeldig',
            'email.exists' => 'Dit e-mailadres is niet bekend',
            'password.required' => 'Wachtwoord is verplicht',
            'password.string' => 'Wachtwoord moet een tekst zijn',
            'password.min' => 'Wachtwoord moet minimaal 6 tekens bevatten',
            'password.confirmed' => 'Wachtwoord komt niet overeen',
        ];
    }
}
