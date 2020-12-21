<?php

namespace App\QueryFilters\Discount;

use App\QueryFilters\Filter;

class Status extends Filter
{

    public function applyFilter($builder)
    {
        $status = request('status');

        if ($status === -1 || $status === null) {
            return $builder;
        }
        if ($status == 3 || $status == 4) {
            if ($status == 3) {
                $status = 1;
            } elseif ($status == 4) {
                $status = 2;
            }
            return $builder->where('discount_type', $status);
        } else {
            return $builder->where('status', $status);
        }
    }
}
