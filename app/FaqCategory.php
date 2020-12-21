<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Faq;

class FaqCategory  extends Model implements TranslatableContract
{
    use Translatable,SoftDeletes;

    public $translatedAttributes = ['name'];
    protected $guarded  = [];

    public function faq(){
        return $this->hasMany(Faq::class);
    }
}
