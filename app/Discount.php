<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Discount extends Model implements TranslatableContract
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = ['title', 'description'];
    protected $guarded  = [];

    const ALL = -1;
    const PUBLISH = 1;
    const EXPIRE = 2;
    const COUPON = 3;
    const OFFER = 4;

    public function discountAssign()
    {
        return $this->hasMany(DiscountAssign::class);
    }
    public function category()
    {
        return $this->morphedByMany(Category::class, 'discount_assigns');
    }
    public function subCategory()
    {
        return $this->morphedByMany(Subcategory::class, 'discount_assigns');
    }
    public function user()
    {
        return $this->morphedByMany(User::class, 'discount_assigns');
    }

    // Accessor & Mutator
    public function getFromDateAttribute($value)
    {
        return date('m-d-Y', strtotime($value));
    }

    public function getToDateAttribute($value)
    {
        return date('m-d-Y', strtotime($value));
    }

    public function setFromDateAttribute($value)
    {
        return $this->attributes['from_date'] = Carbon::createFromFormat('m-d-Y', $value)->format('Y-m-d');
    }

    public function setToDateAttribute($value)
    {
        return $this->attributes['to_date'] = Carbon::createFromFormat('m-d-Y', $value)->format('Y-m-d');
    }
}
