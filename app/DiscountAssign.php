<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountAssign extends Model
{
    protected $guarded  = [];
    public function discount_assigns()
    {
        return $this->morphTo();
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }
}