<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required',
            'company_id'    => 'required',
            'email'         => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'The name field is required.',
            'company_id.required'   => 'The company field is required.',
            'email.required'        => 'The email field is required.',
            'email.email'           => 'The email must be a valid email address.'
        ];
    }
}
