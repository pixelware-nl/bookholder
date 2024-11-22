<?php

namespace App\Http\Requests\Logs;

use App\Rules\NotAuthenticatedUserCompanyRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLogRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', new NotAuthenticatedUserCompanyRule()],
            'rate' => ['required', 'integer'],
            'hours' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'You must select a company.',
            'rate.required' => 'You must fill in a rate.',
            'rate.integer' => 'The rate must be a number.',
            'hours.required' => 'You must fill in the hours.',
            'hours.integer' => 'The hours must be a number.',
            'name.required' => 'You must fill in a name.',
            'name.string' => 'The name must be a string.',
            'description.required' => 'You must fill in a description.',
            'description.string' => 'The description must be a string.',
        ];
    }
}
