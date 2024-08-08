<?php

namespace App\Http\Requests\Companies;

use App\Rules\ValidKVKNumberRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'kvk_to_find.required' => 'The KVK field is required.',
        ];
    }

}
