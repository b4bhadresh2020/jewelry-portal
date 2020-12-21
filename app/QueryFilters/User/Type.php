<?php

namespace App\QueryFilters\User;

use App\QueryFilters\Filter;

class Type extends Filter{

    public function applyFilter($builder){
        $type = request('type');
        return $builder->where('type', $type);
    }
}
