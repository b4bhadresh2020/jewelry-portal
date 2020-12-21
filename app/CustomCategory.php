<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class CustomCategory extends Model implements TranslatableContract
{
    use Translatable;
    const PUBLISH = 1;
    const ARCHIVE = 2;

    public $translatedAttributes = ['name'];
    protected $guarded  = [];
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(" ", "-", strtolower($value));
    }
    public function customSubCategory()
    {
        return $this->hasMany(customSubCategory::class);
    }
}