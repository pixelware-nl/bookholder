<?php

namespace App\Http\Requests;

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
            'company_id' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'company_id' => 'You must select a company.'
        ];
    }
}
