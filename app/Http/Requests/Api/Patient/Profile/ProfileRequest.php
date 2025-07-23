<?php

namespace App\Http\Requests\Api\Patient\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
                'email',
                Rule::unique('users', 'email')
                    ->ignore(Auth::guard('patient')->id()),
            ],
            'phone' => [
                'required',
                'string',
                'max:15',
                Rule::unique('patients', 'phone')
                    ->ignore(Auth::guard('patient')->id()),
            ],
            'age' => 'required|numeric|min:0|max:120',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
        ];
    }
}
