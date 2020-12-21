<?php

namespace App\QueryFilters\Discount;

use App\QueryFilters\Filter;

class FromDate extends Filter
{

    public function applyFilter($builder)
    {
        $from = trim(request('from_date'));
        $to = trim(request('to_date'));
        if ($from != null || $to != null) {
            $from = date('Y-m-d', strtotime(str_replace("/", "-", $from)));
            $to = date('Y-m-d', strtotime(str_replace("/", "-", $to)));
            return $builder->where('from_date', '>=', $from)->where('to_date', '<=', $to);
        } else {
            return $builder;
        }
    }
}