<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'name' => $this->patient
                ? $this->patient->name
                : $this->name,

            'email' => $this->patient
                ? $this->patient->email
                : $this->email,

            'phone' => $this->patient
                ? $this->patient->phone
                : $this->phone,

            'message' => $this->message,

            'isPatient' => $this->patient ? true : false,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
