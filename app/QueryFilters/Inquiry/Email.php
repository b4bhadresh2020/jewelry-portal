<?php

namespace App\QueryFilters\Inquiry;

use App\QueryFilters\Filter;

class Email extends Filter{

    public function applyFilter($builder){
        $value = trim(request('email'));
        return $builder->where('email', 'like', "%{$value}%");
    }
}
