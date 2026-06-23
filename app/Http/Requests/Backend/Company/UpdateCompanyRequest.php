<?php

namespace App\Http\Requests\Backend\Company;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'name' => [
                'required',
                Rule::unique('companies', 'name')->ignore($this->companyId)
            ],
            'email' => 'required|email',
            'initial' => 'required|string|min:2|max:2',
            'phoneNumber' => 'required|string|max:20',
            'description' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'status' => 'required|boolean',
        ];
    }
}
