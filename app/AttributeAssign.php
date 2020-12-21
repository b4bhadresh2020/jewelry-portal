<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeAssign extends Model
{
    protected $guarded  = [];

    public function categoryable()
    {
        return $this->morphTo();
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
