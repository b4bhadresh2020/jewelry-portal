<?php

namespace App\Repositories\Discount;

use App\Repositories\Discount\DiscountRepositoryInterface;
use App\Discount;
use App\DiscountAssign;
use App\Category;
use Illuminate\Pipeline\Pipeline;


class DiscountRepository implements DiscountRepositoryInterface
{
    /**
     * @param array $attributes
     * @return 
     */
    public function store($request)
    {
        $data = Discount::create($request->except([
            'multiple_category_id', 'category_id', 'subcategory_id', 'user_id', 'product_id', 'applicable_type',
        ]));
        $data->category()->attach($request->multiple_category_id);
        $data->subCategory()->attach($request->subcategory_id);
        $data->user()->attach($request->user_id);
        $data->user()->attach($request->product_id);
        return $data;
    }

    public function findById($id)
    {
        return  Discount::find($id);
    }

    public function update($request, $id)
    {
        $data = $this->findById($id)->update($request->except([
            'multiple_category_id', 'category_id', 'subcategory_id', 'user_id', 'product_id', 'applicable_type'
        ]));
        $discount = $this->findById($id);

        switch ($request->applicable_type) {
            case 'category':
                $discount->category()->sync($request->multiple_category_id);
                $discount->subCategory()->detach($request->subcategory_id);
                $discount->user()->detach($request->user_id);
                break;
            case 'subcategory':
                $discount->category()->detach($request->multiple_category_id);
                $discount->subCategory()->sync($request->subcategory_id);
                $discount->user()->detach($request->user_id);
                break;
            case 'user':
                $discount->category()->detach($request->multiple_category_id);
                $discount->subCategory()->detach($request->subcategory_id);
                $discount->user()->sync($request->user_id);
                break;
            default:
                $discount->category()->detach($request->multiple_category_id);
                $discount->subCategory()->detach($request->subcategory_id);
                $discount->user()->sync($request->user_id);
                break;
        }
        return $data;
    }

    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return app(Pipeline::class)
            ->send(Discount::query())
            ->through([
                \App\QueryFilters\Discount\Status::class,
                \App\QueryFilters\Discount\CouponCode::class,
                \App\QueryFilters\Discount\FromDate::class,
                \App\QueryFilters\Discount\Discount::class,
                \App\QueryFilters\Discount\RedeemLimit::class,
                \App\QueryFilters\Discount\Offer::class,
                \App\QueryFilters\User\SortField::class,
            ])
            ->thenReturn()
            ->paginate($items);
    }

    public function findByStatus($status)
    {
        return Discount::select('id')
            ->where('status', $status)
            ->listsTranslations('name')->get();
    }
    public function delete($id, $forceDelete = false)
    {
        if ($forceDelete) {
            return $this->findById($id)->forceDelete();
        } else {
            return $this->findById($id)->delete();
        }
    }
    public function changeStatus($id, $request)
    {
        return $this->findById($id)->update($request);
    }
}