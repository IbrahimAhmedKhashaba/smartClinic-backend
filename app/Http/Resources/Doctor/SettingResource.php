<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'about' => $this->about,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'facebook' => $this->facebook,
            'whatsapp' => $this->whatsapp,
            'daily_appointments_limit' => $this->whenLoaded($this->daily_appointments_limit),
            'appointment_duration' => $this->whenLoaded($this->appointment_duration),
        ];
    }
}
