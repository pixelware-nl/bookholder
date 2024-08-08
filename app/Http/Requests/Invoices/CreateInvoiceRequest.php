<?php

namespace App\Http\Requests\Invoices;

use App\Rules\NotAuthenticatedUserCompanyRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

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
            'company_id.required' => 'You must select a company.',
            'start_date.required' => 'You must select a start date.',
            'start_date.date' => 'The filled in date is not correct.',
            'end_date.required' => 'You must select an end date.',
            'end_date.date' => 'The filled in date is not correct.',
            'end_date.after_or_equal' => 'The end date must be after or equal to start date.',
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
