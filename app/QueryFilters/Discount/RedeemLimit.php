<?php

namespace App\QueryFilters\Discount;

use App\QueryFilters\Filter;

class RedeemLimit extends Filter
{

    public function applyFilter($builder)
    {
        $value = trim(request('redeem_limit'));
        return $builder->where('redeem_limit', 'like', "%{$value}%");
    }
}