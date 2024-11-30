<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PasswordResetRequest
 * @package App\Http\Requests\Auth
 * @property string $email
 */
class PasswordResetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'E-mail is verplicht',
            'email.email' => 'E-mail is ongeldig',
            'email.exists' => 'Dit e-mailadres is niet bekend',
        ];
    }
}
