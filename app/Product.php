<?php

namespace App;

use App\Traits\Helpers\ProductHelper;
use App\Traits\MediaRelationship;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements TranslatableContract
{
    const SORT_POPULAR = 0;
    const SORT_A_TO_Z = 1;
    const SORT_Z_TO_A = 2;
    const SORT_PRICE_LOW_TO_HIGH = 3;
    const SORT_PRICE_HIGH_TO_LOW = 4;

    const SORT_MAPPING = [
        self::SORT_POPULAR              => 'Popular',
        self::SORT_A_TO_Z               => 'Name, A to Z',
        self::SORT_Z_TO_A               => 'Name, Z to A',
        self::SORT_PRICE_LOW_TO_HIGH    => 'Price, low to high',
        self::SORT_PRICE_HIGH_TO_LOW    => 'Price, high to low',
    ];

    use Translatable, MediaRelationship, SoftDeletes, ProductHelper;

    public $translatedAttributes = ['title', 'description', 'sort_description'];
    protected $guarded  = [];

    public function productAttribute()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id')->withTrashed();
    }

    public function defauktProductAttribute()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id')->where('is_default', true)->withTrashed();
    }


    public function inquiry()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTranslation('name');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id')->withTranslation('name');
    }

    public function productCollection()
    {
        return $this->hasMany(ProductCollection::class, 'product_id');
    }

    // Accessor & Mutator
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(" ", "-", strtolower($value));
    }

    public function getFullNameAttribute()
    {
        return str_replace("-", "-", strtolower($this->slug));
    }
}
