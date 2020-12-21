<?php

namespace App\QueryFilters\Inquiry;

use App\QueryFilters\Filter;

class ToDate extends Filter{
    public function applyFilter($builder){
        $fromDate = trim(request('from_date'));
        $toDate = trim(request('to_date'));
        if($fromDate!=null)
        {
            $strReplaceFrom=str_replace('/','-',$fromDate);
            $dateFrom=date('Y-m-d',strtotime($strReplaceFrom));
            $strReplaceTo=str_replace('/','-',$toDate);
            $dateTo=date('Y-m-d',strtotime($strReplaceTo));
            return $builder->whereBetween('created_at', [$dateFrom,$dateTo]);
        }else{
            $value = trim(request('name'));
            return $builder->where('first_name', 'like', "%{$value}%");
        }
    }
}
