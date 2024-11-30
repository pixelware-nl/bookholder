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
            'kvk.required' => 'U moet een KVK-nummer invoeren.',
            'kvk.valid_kvk_number' => 'Dit KVK-nummer is niet geldig.',
            'name.required' => 'U moet een naam invoeren.',
            'name.max' => 'De naam mag niet langer zijn dan 256 tekens.',
            'street_address.required' => 'U moet een straatadres invoeren.',
            'street_address.max' => 'Het straatadres mag niet langer zijn dan 256 tekens.',
            'city.required' => 'U moet een stad invoeren.',
            'postal_code.required' => 'U moet een postcode invoeren.',
            'postal_code.valid_postal_code' => 'Deze postcode is niet geldig.',
            'country.required' => 'U moet een land invoeren.',
        ];
    }
}
