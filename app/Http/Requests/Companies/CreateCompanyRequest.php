<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'street_address' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'postal_code' => ['required'],
            'country' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
        ];
    }
}
