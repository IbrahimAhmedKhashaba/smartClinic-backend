<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DaysOff extends Model
{
    //
    use HasTranslations;
    protected $fillable = ['day'];
    public $translatable = ['day'];
}
