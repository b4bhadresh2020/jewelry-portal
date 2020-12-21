<?php

namespace App\Repositories\Inquiry;

use App\Repositories\Inquiry\InquiryProductRepositoryInterface;
use App\Inquiry;
use Illuminate\Pipeline\Pipeline;



class InquiryProductRepository implements InquiryProductRepositoryInterface
{

    public function findById($id){
        return Inquiry::find($id);
    }


    public function filterWithPaginate(){

        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return app(Pipeline::class)
                ->send(Inquiry::query()->where('product_id','!=',NULL))
                ->through([
                    \App\QueryFilters\Inquiry\Status::class,
                    \App\QueryFilters\Inquiry\Email::class,
                    \App\QueryFilters\Inquiry\Name::class,
                    \App\QueryFilters\Inquiry\PhoneNumber::class,
                    \App\QueryFilters\Inquiry\ToDate::class,
                ])
                ->thenReturn()
                ->paginate($items);
    }
}
