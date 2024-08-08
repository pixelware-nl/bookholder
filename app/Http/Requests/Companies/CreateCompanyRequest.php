<?php

namespace App\Http\Requests\Companies;

use App\Rules\ValidKVKNumberRule;
use App\Rules\ValidPostalCodeRule;
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
            'name' => ['required', 'max:256'],
            'kvk' => ['required', 'unique:companies,kvk', new ValidKVKNumberRule()],
            'street_address' => ['required', 'max:256'],
            'city' => ['required'],
            'postal_code' => ['required', new ValidPostalCodeRule()],
            'country' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'kvk.unique' => 'This KVK already exists in the database.',
        ];
    }
}
