<?php

namespace App\QueryFilters\User;

use App\QueryFilters\Filter;

class Phone extends Filter
{

    public function applyFilter($builder)
    {
        $value = trim(request('phone'));
        return $builder->orWhere('phone', 'like', "%{$value}%");
    }
}
