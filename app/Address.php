<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    const TYPE_BILLING  = 1;
    const TYPE_SHIPPING = 2;

    const ADDRESS_AS_HOME   = 1;
    const ADDRESS_AS_OFFICE = 2;
    const ADDRESS_AS_OTHER  = 3;

    protected $table = "addresses";
    protected $guarded  = [];

    /**
     * @return City|null
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
