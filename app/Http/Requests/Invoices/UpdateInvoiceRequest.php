<?php

namespace App\Http\Requests\Invoices;

use App\Rules\NotAuthenticatedUserCompanyRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateInvoiceRequest
 *
 * @property int $company_id
 * @property int $client_id
 * @property string $invoice_date
 * @property string $due_date
 * @property string $description
 * @property array $logs
 */
class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', new NotAuthenticatedUserCompanyRule],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => __('validation.company_id.required'),
            'start_date.required' => __('validation.start_date.required'),
            'start_date.date' => __('validation.start_date.date'),
            'end_date.required' => __('validation.end_date.required'),
            'end_date.date' => __('validation.end_date.date'),
            'end_date.after_or_equal' => __('validation.end_date.after_or_equal'),
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
