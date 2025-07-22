<?php

namespace App\Http\Requests\Api\Patient\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            //
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:patients,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|unique:patients,phone|max:15',
            'age' => 'required|numeric|min:0|max:120',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
        ];
    }
}
