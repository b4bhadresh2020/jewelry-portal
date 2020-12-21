<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $guarded  = [];

    /**
     * @return Country|null
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * @return State|null
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
