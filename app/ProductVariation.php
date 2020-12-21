<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $guarded  = [];

    public function attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function options(){
        return $this->belongsTo(Option::class, 'option_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'sku', 'sku')->withTrashed();
    }
}
