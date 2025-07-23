<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    //
    use HasTranslations;
    public $translatable = ['about' , 'address'];
    protected $fillable = [
        'about',
        'email',
        'phone',
        'address',
        'facebook',
        'whatsapp',
        'open_time',
        'close_time',
        'daily_appointments_limit',
        'appointment_duration',
    ];
}
