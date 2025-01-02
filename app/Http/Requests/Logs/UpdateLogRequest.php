<?php

namespace App\Http\Requests\Logs;

use App\Rules\NotAuthenticatedUserCompanyRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateLogRequest
 * @package App\Http\Requests\Logs
 * @property int $company_id
 * @property int $rate
 * @property int $hours
 * @property string $name
 * @property string $description
 */
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
            'company_id.required' => __('validation.company_id.required'),
            'rate.required' => __('validation.rate.required'),
            'rate.integer' => __('validation.rate.integer'),
            'hours.required' => __('validation.hours.required'),
            'hours.integer' => __('validation.hours.integer'),
            'name.required' => __('validation.name.required'),
            'name.string' => __('validation.name.string'),
            'description.required' => __('validation.description.required'),
            'description.string' => __('validation.description.string'),
        ];
    }
}
