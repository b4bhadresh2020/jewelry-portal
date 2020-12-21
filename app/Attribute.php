<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Traits\MediaRelationship;

class Attribute extends Model implements TranslatableContract
{
    use Translatable, MediaRelationship;

    public $translatedAttributes = ['name'];
    protected $guarded  = [];

    public function option()
    {
        return $this->hasMany(Option::class, 'attribute_id');
    }
}
