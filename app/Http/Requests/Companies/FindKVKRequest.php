<?php

namespace App\Http\Requests\Companies;

use App\Rules\ValidKVKNumberRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FindKVKRequest
 *
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
            'kvk_to_find' => ['required', new ValidKVKNumberRule],
        ];
    }

    public function messages(): array
    {
        return [
            'kvk_to_find.required' => __('validation.kvk_to_find.required'),
            'kvk_to_find.valid_kvk_number' => __('validation.kvk_to_find.valid_kvk_number'),
        ];
    }
}
