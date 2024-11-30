<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateUserRequest
 * @package App\Http\Requests\Auth
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string $company_id
 */
class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'company_id' => ['required', 'exists:companies,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'firstname.required' => 'Voornaam is verplicht',
            'firstname.string' => 'Voornaam moet een tekst zijn',
            'firstname.max' => 'Voornaam mag maximaal 255 tekens bevatten',
            'lastname.required' => 'Achternaam is verplicht',
            'lastname.string' => 'Achternaam moet een tekst zijn',
            'lastname.max' => 'Achternaam mag maximaal 255 tekens bevatten',
            'email.required' => 'E-mail is verplicht',
            'email.string' => 'E-mail moet een tekst zijn',
            'email.email' => 'E-mail is ongeldig',
            'email.max' => 'E-mail mag maximaal 255 tekens bevatten',
            'email.unique' => 'E-mail is al in gebruik',
            'password.required' => 'Wachtwoord is verplicht',
            'password.string' => 'Wachtwoord moet een tekst zijn',
            'password.min' => 'Wachtwoord moet minimaal 6 tekens bevatten',
            'password.confirmed' => 'Wachtwoord komt niet overeen',
            'company_id.required' => 'Bedrijf is verplicht',
            'company_id.exists' => 'Bedrijf bestaat niet',
        ];
    }
}
