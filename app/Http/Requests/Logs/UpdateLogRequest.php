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
            'company_id.required' => 'U moet een bedrijf selecteren.',
            'rate.required' => 'U moet een tarief invullen.',
            'rate.integer' => 'Het tarief moet een getal zijn.',
            'hours.required' => 'U moet de uren invullen.',
            'hours.integer' => 'De uren moeten een getal zijn.',
            'name.required' => 'U moet een naam invullen.',
            'name.string' => 'De naam moet een string zijn.',
            'description.required' => 'U moet een beschrijving invullen.',
            'description.string' => 'De beschrijving moet een string zijn.',
        ];
    }
}
