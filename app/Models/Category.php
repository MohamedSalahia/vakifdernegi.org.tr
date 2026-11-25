<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Category extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['name'];
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);

    }//end of products

}
