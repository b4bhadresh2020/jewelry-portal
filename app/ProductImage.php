<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded  = [];

    public function media(){
        return $this->morphMany(Media::class, 'mediable');
    }
}
