<?php

namespace App\Http\Requests\Companies;

use App\Rules\ValidIBANRule;
use App\Rules\ValidKVKNumberRule;
use App\Rules\ValidPostalCodeRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateCompanyRequest
 *
 * @property string $name
 * @property string $kvk
 * @property string|null $iban
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
            'kvk' => ['required', new ValidKVKNumberRule],
            'iban' => ['nullable', new ValidIBANRule],
            'street_address' => ['required', 'max:256'],
            'city' => ['required'],
            'postal_code' => ['required', new ValidPostalCodeRule],
            'country' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'kvk.required' => __('validation.kvk.required'),
            'kvk.valid_kvk_number' => __('validation.kvk.valid_kvk_number'),
            'name.required' => __('validation.name.required'),
            'name.max' => __('validation.name.max'),
            'street_address.required' => __('validation.street_address.required'),
            'street_address.max' => __('validation.street_address.max'),
            'city.required' => __('validation.city.required'),
            'postal_code.required' => __('validation.postal_code.required'),
            'postal_code.valid_postal_code' => __('validation.postal_code.valid_postal_code'),
            'country.required' => __('validation.country.required'),
        ];
    }
}
