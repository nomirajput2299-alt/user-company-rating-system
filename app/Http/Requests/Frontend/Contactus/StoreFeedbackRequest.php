<?php

namespace App\Http\Requests\Frontend\Contactus;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'required|string|min:10|max:20',
            'subject' => 'required|string|min:5|max:255',
            'message' => 'required|string|min:10|max:5000',
        ];
    }
}
