<?php

namespace App\QueryFilters\Discount;

use App\QueryFilters\Filter;

class CouponCode extends Filter
{

    public function applyFilter($builder)
    {
        $value = trim(request('coupon_code'));
        return $builder->where('coupon_code', 'like', "%{$value}%");
    }
}