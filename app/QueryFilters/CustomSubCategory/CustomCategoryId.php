<?php

namespace App\QueryFilters\CustomSubCategory;

use App\QueryFilters\Filter;

class CustomCategoryId extends Filter
{
    public function applyFilter($builder)
    {
        if (request('custom_category_id') == -1) {
            return $builder;
        }
        return $builder->where('custom_category_id', request('custom_category_id'));
    }
}