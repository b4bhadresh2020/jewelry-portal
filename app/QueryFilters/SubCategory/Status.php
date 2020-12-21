<?php

namespace App\QueryFilters\SubCategory;

use App\QueryFilters\Filter;

class Status extends Filter
{
    public function applyFilter($builder)
    {
        if (request('status') == null) {
            return $builder;
        }
        return $builder->where('status', request('status'));
    }
}
