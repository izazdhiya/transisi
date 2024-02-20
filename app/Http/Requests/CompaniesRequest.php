<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaniesRequest extends FormRequest
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
            'name'    => 'required',
            'email'   => 'required|email',
            'logo'    => 'required|image|mimes:png|dimensions:min_width=100,min_height=100|max:2048',
            'website' => 'required|url',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'The name field is required.',
            'email.required'        => 'The email field is required.',
            'email.email'           => 'The email must be a valid email address.',
            'logo.required'         => 'The logo field is required.',
            'logo.image'            => 'The logo must be an image.',
            'logo.mimes'            => 'The logo must be a PNG file.',
            'logo.dimensions'       => 'The logo must have a minimum width and height of 100x100 pixels.',
            'logo.max'              => 'The logo may not be greater than 2 MB.',
            'website.required'      => 'The website field is required.',
            'website.url'           => 'The website must be a valid URL.',
        ];
    }
}
