<?php

namespace App\QueryFilters\Inquiry;

use App\QueryFilters\Filter;

class SortField extends Filter{

    public function applyFilter($builder){
        $sort_direction = request('sort_direction') ?? "DESC";
        return $builder->orderBy(request('sort_field'), $sort_direction);
    }
}
