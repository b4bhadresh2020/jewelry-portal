<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model implements TranslatableContract
{

    use Translatable,SoftDeletes;
    public $translatedAttributes = ['header','title','description','link_text'];
    protected $guarded  = [];
}
