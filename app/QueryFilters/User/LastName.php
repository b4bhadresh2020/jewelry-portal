<?php

namespace App\QueryFilters\User;

use App\QueryFilters\Filter;

class LastName extends Filter
{

    public function applyFilter($builder)
    {
        $value = trim(request('last_name'));
        return $builder->orWhere('last_name', 'like', "%{$value}%");
    }
}
