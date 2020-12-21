<?php

namespace App\Traits\Helpers;

use App\ProductAttribute;

trait ProductHelper
{
    public function isSubCategory(): bool
    {
        return ($this->subCategory()->count() != 0) ? true : false;
    }

    public function attributes()
    {
        $products = self::query()
            ->when(
                $this->isSubCategory(),
                function ($query) {
                    return $query->with(['subCategory.attributeAssign']);
                },
                function ($query) {
                    return $query->with(['category.attributeAssign']);
                }
            )->where('id', $this->id)
            ->first();
        if ($this->isSubCategory()) {
            return $products->subCategory->attributeAssign;
        } else {
            return $products->category->attributeAssign;
        }
    }

    public function relatedProducts()
    {
        if ($this->related_products) {
            $relatedProductsId = explode(",", $this->related_products);
            return ProductAttribute::whereIn('product_id', $relatedProductsId)->where('is_default', true)->get();
        }
        return null;
    }
}
