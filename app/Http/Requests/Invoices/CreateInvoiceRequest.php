<?php

namespace App\Http\Requests\Invoices;

use App\Rules\NotAuthenticatedUserCompanyRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateInvoiceRequest
 * @package App\Http\Requests\Invoices
 * @property int $company_id
 * @property int $client_id
 * @property string $invoice_date
 * @property string $due_date
 * @property string $description
 * @property array $logs
 */
class CreateInvoiceRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', new NotAuthenticatedUserCompanyRule()],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'U moet een bedrijf selecteren.',
            'start_date.required' => 'U moet een startdatum selecteren.',
            'start_date.date' => 'De ingevulde datum is niet correct.',
            'end_date.required' => 'U moet een einddatum selecteren.',
            'end_date.date' => 'De ingevulde datum is niet correct.',
            'end_date.after_or_equal' => 'De einddatum moet na of gelijk aan de startdatum zijn.',
        ];
    }

    public function passedValidation(): void
    {
        $this->replace([
            'company_id' => $this->input('company_id'),
            'start_date' => Carbon::createFromFormat('Y-m-d', $this->input('start_date'))->startOfDay(),
            'end_date' => Carbon::createFromFormat('Y-m-d', $this->input('end_date'))->endOfDay(),
        ]);
    }
}
