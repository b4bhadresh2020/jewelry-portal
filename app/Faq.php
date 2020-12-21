<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\FaqCategory;

class Faq extends  Model implements TranslatableContract
{
    use Translatable,SoftDeletes;

    public $translatedAttributes = ['question','answer'];

    protected $guarded  = [];

    public function faqCategory(){
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }
}
