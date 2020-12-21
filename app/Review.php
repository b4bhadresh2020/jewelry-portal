<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $guarded  = [];

    // public function productAttribute()
    // {

    //     return $this->hasMany(ProductAttribute::class);
    // }

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}
