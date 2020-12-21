<?php

namespace App\QueryFilters\Discount;

use App\QueryFilters\Filter;

class Discount extends Filter
{

    public function applyFilter($builder)
    {
        $value = trim(request('discount'));
        return $builder->where('amount', 'like', "%{$value}%");
    }
}