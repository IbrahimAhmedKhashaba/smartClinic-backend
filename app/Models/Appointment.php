<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'symptoms_durations',
        'status',
        'date',
        'time',
    ];

    function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => match ($value) {
                0 => __('custom.waiting'),
                1 => __('custom.checked'),
                2 => __('custom.lated'),
                default => __('custom.waiting'),
            },
            set: fn($value) => match ($value) {
                'waiting' => 0,
                'checked' => 1,
                'lated' => 2,
                default => 0,
            }
        );
    }

    function symptomsDuration(): Attribute
    {
        return Attribute::make(
            get: fn($value) => match ($value) {
                0 => __('custom.less_than_24_hours'),
                1 => __('custom.from_1_to_3_days'),
                2 => __('custom.more_than_3_days'),
                default => __('custom.more_than_3_days'),
            },
            set: fn($value) => match ($value) {
                'less_than_24_hours' => 0,
                'from_1_to_3_days' => 1,
                'more_than_3_days' => 2,
                default => 2,
            }
        );
    }


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class);
    }

    public function diseases()
    {
        return $this->belongsToMany(Disease::class);
    }

    public function drugs()
    {
        return $this->hasMany(Drug::class);
    }

    public function medications()
    {
        return $this->hasMany(Medication::class);
    }

    public function other_symptoms()
    {
        return $this->hasMany(OtherSymptom::class);
    }

    public function other_diseases()
    {
        return $this->hasMany(OtherDisease::class);
    }
}
