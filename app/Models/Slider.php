<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['name', 'subhead', 'description', 'image_alt', 'button_name', 'button_url'];
    protected $guarded = [];

}
