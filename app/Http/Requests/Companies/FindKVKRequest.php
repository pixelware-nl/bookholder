<?php

namespace App\Http\Requests\Companies;

use App\Rules\ValidKVKNumberRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FindKVKRequest
 * @package App\Http\Requests\Companies
 * @property string $kvk_to_find
 */
class FindKVKRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'kvk_to_find' => ['required', new ValidKVKNumberRule()]
        ];
    }

    public function messages(): array
    {
        return [
            'kvk_to_find.required' => 'U moet een KVK-nummer invoeren.',
            'kvk_to_find.valid_kvk_number' => 'Dit KVK-nummer is niet geldig.',
        ];
    }

}
