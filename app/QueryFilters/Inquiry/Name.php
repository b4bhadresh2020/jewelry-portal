<?php

namespace App\QueryFilters\Inquiry;

use App\QueryFilters\Filter;

class Name extends Filter{

    public function applyFilter($builder){
        $value = trim(request('name'));
        return $builder->where('first_name', 'like', "%{$value}%");
    }
}
