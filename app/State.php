<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $guarded  = [];

    /**
     * @return City|null
     */
    public function city()
    {
        return $this->hasMany(City::class);
    }

    /**
     * @return Country|null
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
