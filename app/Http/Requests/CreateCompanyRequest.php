<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\NotAuthenticatedUserCompany;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCompanyRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'street_address' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'postal_code' => ['required'],
            'country' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
        ];
    }
}
