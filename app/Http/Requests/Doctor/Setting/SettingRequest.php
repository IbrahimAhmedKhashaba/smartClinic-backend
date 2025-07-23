<?php

namespace App\Http\Requests\Doctor\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
            'about' => 'required|array',
            'about.en' => 'required|string',
            'about.ar' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'address.*' => 'required|string|max:255',
            'daily_working_hours' => 'nullable|string|max:50',
            'facebook' => 'nullable|url',
            'whatsapp' => 'nullable|url',
            'daily_appointments_limit' => 'nullable|integer|min:1',
            'appointment_duration' => 'nullable|integer|min:1|max:120',
        ];
    }
}
