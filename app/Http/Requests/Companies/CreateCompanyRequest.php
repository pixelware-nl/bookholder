<?php

namespace App\Http\Requests\Companies;

use App\Rules\ValidKVKNumberRule;
use App\Rules\ValidPostalCodeRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateCompanyRequest
 * @package App\Http\Requests\Companies
 * @property string $name
 * @property string $kvk
 * @property string $street_address
 * @property string $city
 * @property string $postal_code
 * @property string $country
 */
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
            'kvk' => ['required', new ValidKVKNumberRule()],
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
