<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = [
        'patient_id',
        'name',
        'email',
        'phone',
        'message',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
