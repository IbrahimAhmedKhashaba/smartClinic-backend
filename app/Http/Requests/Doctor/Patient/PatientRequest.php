<?php

namespace App\Http\Requests\Doctor\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('patients', 'email')->ignore($this->route('patient')),
            ],
            'password' => 'required|string|min:6|confirmed',
            'phone' => [
                'required',
                'string',
                'max:15',
                Rule::unique('patients', 'phone')->ignore($this->route('patient')),
            ],
            'age' => 'required|numeric|min:0|max:120',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
        ];
    }
}
