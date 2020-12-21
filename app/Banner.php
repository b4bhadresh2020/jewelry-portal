<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Banner extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['header','title','description','link_text'];
    protected $guarded  = [];
}
