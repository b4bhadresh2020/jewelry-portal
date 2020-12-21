<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $guarded  = [];

    /**
     * @return State|null
     */
    public function state()
    {
        return $this->hasMany(State::class);
    }

    /**
     * @return City|null
     */
    public function city()
    {
        return $this->hasMany(City::class);
    }
}
