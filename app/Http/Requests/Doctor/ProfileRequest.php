<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:255|min:3',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore(Auth::id()),
            ],
        ];
    }
}
