<?php

namespace App\QueryFilters\User;

use App\QueryFilters\Filter;

class Email extends Filter
{

    public function applyFilter($builder)
    {
        $value = trim(request('email'));
        return $builder->orWhere('email', 'like', "%{$value}%");
    }
}
