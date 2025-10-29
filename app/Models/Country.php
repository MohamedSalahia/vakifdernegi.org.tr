<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, Translatable, SoftDeletes;

    protected $fillable = ['flag', 'code',];

    public $translatedAttributes = ['name'];

    //attr
    public function getFlagPathAttribute()
    {
        return asset('storage/uploads/' . $this->flag);

    }// end of getFlagPathAttribute

    //scope

    //rel
    public function timezone()
    {
        return $this->belongsTo(Timezone::class);

    }// end of timezone

    public function governorates()
    {
        return $this->hasMany(Governorate::class);

    }// end of governorates

    public function areas()
    {
        return $this->hasManyThrough(Area::class, Governorate::class);

    }// end of areas

}// end of model
