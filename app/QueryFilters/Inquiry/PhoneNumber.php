<?php

namespace App\QueryFilters\Inquiry;

use App\QueryFilters\Filter;

class PhoneNumber extends Filter{

    public function applyFilter($builder){
        $value = trim(request('phone_number'));
        return $builder->where('phone', 'like', "%{$value}%");
    }
}
