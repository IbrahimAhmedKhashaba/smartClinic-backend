<?php

namespace App\Http\Requests\Doctor\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
            'status' => 'required|in:waiting,checked,lated',
        ];
    }
}
