<?php

namespace App\QueryFilters\SubCategory;

use App\QueryFilters\Filter;

class CategoryId extends Filter
{
    public function applyFilter($builder)
    {
        if (request('category_id') == -1) {
            return $builder;
        }
        return $builder->where('category_id', request('category_id'));
    }
}
