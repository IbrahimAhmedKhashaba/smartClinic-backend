<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $guest = Auth::guard('patient')->guest();

        return [
            'name' => [$guest ? 'required' : 'nullable', 'string', 'max:255'],
            'email' => [$guest ? 'required' : 'nullable', 'email', 'max:255'],
            'phone' => [$guest ? 'required' : 'nullable', 'string', 'max:20'],
            'message' => ['required', 'string'],
        ];
    }
}
