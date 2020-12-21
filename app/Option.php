<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Traits\MediaRelationship;

class Option extends Model implements TranslatableContract
{
    use Translatable, MediaRelationship;

    public $translatedAttributes = ['name'];
    protected $guarded  = [];

    /**
     * @return Attribute|null
     */
    public function attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
