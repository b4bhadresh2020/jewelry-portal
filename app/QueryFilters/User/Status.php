<?php

namespace App\QueryFilters\User;

use App\QueryFilters\Filter;

class Status extends Filter{

    public function applyFilter($builder){
        $status = request('status');
        if($status === -1 || $status === null) return $builder;
        return $builder->where('status', $status);
    }
}
