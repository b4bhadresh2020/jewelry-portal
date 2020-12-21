<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class CustomSubCategory extends Model implements TranslatableContract
{
    use Translatable;
    const PUBLISH = 1;
    const ARCHIVE = 2;

    public $translatedAttributes = ['content'];
    protected $guarded  = [];

    // Accessor & Mutator
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(" ", "-", strtolower($value));
    }
    public function customCategory()
    {
        return $this->belongsTo(CustomCategory::class, 'custom_category_id');
    }
}