<?php

namespace App;

use App\Traits\Helpers\ProductAttributeHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    protected $guarded  = [];
    use SoftDeletes, ProductAttributeHelper;

    const DRAFT = 1;
    const PUBLISH = 2;
    const ARCHIVE = 3;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }

    public function review()
    {
        return $this->hasMany(Review::class);
        
    }

    public function attributeOption()
    {
        return $this->hasMany(Option::class, 'attribute_id', 'attribute_id');
    }

    public function productPrice()
    {
        return $this->hasOne(ProductPrice::class, 'sku', 'sku');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'sku', 'sku');
    }

    public function imagesWithoutDefault()
    {
        return $this->hasMany(ProductImage::class, 'sku', 'sku')->where('is_default', 0);
    }

    public function defaultImage()
    {
        return $this->hasOne(ProductImage::class, 'sku', 'sku')->where('is_default', 1)->latest();
    }

    public function productVariation()
    {
        return $this->hasMany(ProductVariation::class, 'sku', 'sku');
    }
}
