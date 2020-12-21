<?php

namespace App\QueryFilters\Discount;

use App\QueryFilters\Filter;

class Offer extends Filter
{

    public function applyFilter($builder)
    {
        $value = trim(request('offer'));
        if ($value != null) {
            return $builder->join('discount_translations', 'discount_translations.discount_id', '=', 'discounts.id')->where('discount_translations.title', 'like', "%{$value}%");
        } else {
            return $builder;
        }
    }
}