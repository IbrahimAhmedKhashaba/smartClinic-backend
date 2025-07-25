<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Disease extends Model
{
    //
    use HasTranslations, HasFactory;
    public $translatable = ['name'];
    protected $fillable = ['name'];
}
