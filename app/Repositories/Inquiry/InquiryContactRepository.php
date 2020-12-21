<?php

namespace App\Repositories\Inquiry;

use App\Repositories\Inquiry\InquiryContactRepositoryInterface;
use App\Inquiry;
use Illuminate\Pipeline\Pipeline;


class InquiryContactRepository implements InquiryContactRepositoryInterface
{

    public function store($request)
    {
        return Inquiry::create($request);
    }


    /**
     * @param int $id
     * @param array $attributes
     * @return
     */
    public function update($id, array $attributes){
        return Inquiry::find($id)->update($attributes);
    }

    /**
     * @return
     */

    /**
     * @return
     */
    public function findById($id){
        return Inquiry::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */


    /**
     * @return
     */
    public function filterWithPaginate(){
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return app(Pipeline::class)
                ->send(Inquiry::query()->where('product_id',NULL))
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
