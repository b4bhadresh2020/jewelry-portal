<?php

namespace App\Repositories\ProductAttribute;

use App\Product;
use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use App\ProductAttribute;
use Illuminate\Support\Facades\App;

class ProductAttributeRepository implements ProductAttributeRepositoryInterface
{
    /**
     * @param array $attributes
     * @return ProductAttribute
     */
    public function store(array $attributes){

    }

    /**
     * @param int $id
     * @param array $attributes
     * @return boolean
     */
    public function update($id, array $attributes){

    }

    /**
     * @return ProductAttribute
     */
    public function findAll(){
        return ProductAttribute::all();
    }

    /**
     * @return ProductAttribute
     */
    public function findById($id){
        return ProductAttribute::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = false){
        if($forceDelete){
            return $this->findById($id)->forceDelete();
        }else{
            return $this->findById($id)->delete();
        }
    }

    /**
     * @return ProductAttribute
     */
    public function filterWithPaginate(){

        $title              = request('title');
        $sku                = request('sku');
        $from_date          = request('from_date') ? date('Y-m-d', strtotime(request('from_date'))) : null;
        $to_date            = request('to_date') ? date('Y-m-d', strtotime(request('to_date'))) : null;
        $sort_direction     = request('sort_direction') ?? "DESC";
        $items              = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        $status             = request()->status;

        if ($status == ProductAttribute::DRAFT) {
            $product = Product::where('status_id', ProductAttribute::DRAFT);
            $product->when($title,function($query) use ($title){
                $query->whereTranslationLike('title', '%'.$title.'%');
            });
        }else{
            $product =  ProductAttribute::where('status_id', $status);
            if (!empty($title)) {
                $product->whereHas('product', function($q) use ($title){
                    return $q->whereTranslationLike('title', '%'.$title.'%');
                });
            }
            $product->when($sku, function($query) use ($sku){
                $query->where('sku','like', '%'.$sku.'%');
            });
        }

        $product->when($from_date && $to_date,
            function($query) use ($from_date, $to_date){
                $query->whereBetween('created_at', array($from_date, $to_date));
            },
            function($query) use ($from_date, $to_date){
                $query->when($from_date, function ($innerQuery) use ($from_date){
                    return $innerQuery->whereDate('created_at', '>=', date('Y-m-d', strtotime($from_date)));
                });
                $query->when($to_date, function ($innerQuery) use ($to_date){
                    return $innerQuery->whereDate('created_at', '<=',  date('Y-m-d', strtotime($to_date)));
                });
            })->orderBy(request('sort_field'), $sort_direction);

        return $product->paginate($items);
    }

    /**
     * @param int $id
     * @param int $status
     * @return ProductAttribute
     */
    public function changeStatus($id, $status)
    {
        return ProductAttribute::find($id)->update(['status_id'=> $status]);
    }

    public function findBySku($sku)
    {
        return ProductAttribute::where('sku', $sku)->first();
    }

}
