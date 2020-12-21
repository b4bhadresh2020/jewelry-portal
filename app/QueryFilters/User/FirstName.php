<?php

namespace App\QueryFilters\User;

use App\QueryFilters\Filter;

class FirstName extends Filter
{

    public function applyFilter($builder)
    {
        $value = trim(request('first_name'));
        return $builder->orWhere('first_name', 'like', "%{$value}%");
    }
}
