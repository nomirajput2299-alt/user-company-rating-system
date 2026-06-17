<?php

namespace App\Http\Requests\Backend\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'phoneNumber' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG|max:2048',
            'roles' => 'required|exists:roles,name',
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6',
            'status' => 'required|boolean',
        ];
    }
}
