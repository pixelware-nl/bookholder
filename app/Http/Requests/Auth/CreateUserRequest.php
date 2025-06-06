<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateUserRequest
 *
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
            'firstname.required' => __('validation.firstname.required'),
            'firstname.string' => __('validation.firstname.string'),
            'firstname.max' => __('validation.fistname.max'),
            'lastname.required' => __('validation.lastname.required'),
            'lastname.string' => __('validation.lastname.string'),
            'lastname.max' => __('validation.lastname.max'),
            'email.required' => __('validation.email.required'),
            'email.string' => __('validation.email.required'),
            'email.email' => __('validation.email.required'),
            'email.max' => __('validation.email.required'),
            'email.unique' => __('validation.email.required'),
            'password.required' => __('validation.password.required'),
            'password.string' => __('validation.password.required'),
            'password.min' => __('validation.password.required'),
            'password.confirmed' => __('validation.password.required'),
            'company_id.required' => __('validation.company_id.required'),
        ];
    }
}
