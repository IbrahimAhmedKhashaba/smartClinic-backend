<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient' => new PatientResource($this->whenLoaded('patient')),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'symptoms' => GeneralResource::collection($this->whenLoaded('symptoms')),
            'other_symptoms' => GeneralResource::collection($this->whenLoaded('other_symptoms')),
            'symptoms_duration' => $this->symptoms_duration,
            'diseases' => GeneralResource::collection($this->whenLoaded('diseases')),
            'other_diseases' => GeneralResource::collection($this->whenLoaded('other_diseases')),
            'medications' => GeneralResource::collection($this->whenLoaded('medications')),
            'drugs' => GeneralResource::collection($this->whenLoaded('drugs')),
        ];
    }
}
