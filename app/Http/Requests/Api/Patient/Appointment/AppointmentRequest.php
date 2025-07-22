<?php

namespace App\Http\Requests\Api\Patient\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('patient')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $data = [
            //
            'symptoms_duration' => 'required|in:less_than_24_hours,from_1_to_3_days,more_than_3_days',
            'status' => 'nullable|in:waiting,checked,lated',

            'symptoms' => 'nullable|array',
            'symptoms.*' => 'nullable|exists:symptoms,id',
            
            'diseases' => 'nullable|array',
            'diseases.*' => 'nullable|exists:diseases,id',

            'other_symptoms' => 'nullable|array',
            'other_symptoms.*' => 'nullable|string|min:3|max:255',

            'other_medications' => 'nullable|array',
            'other_medications.*' => 'nullable|string|min:3|max:255',

            'medications' => 'nullable|array',
            'medications.*' => 'nullable|string|min:3|max:255',

            'drugs' => 'nullable|array',
            'drugs.*' => 'nullable|string|min:3|max:255',
        ];

        if($this->isMethod('put')) {
            $data['symptoms_duration'] = 'nullable|in:less_than_24_hours,from_1_to_3_days,more_than_3_days';
        }

        return $data;
    }
}
