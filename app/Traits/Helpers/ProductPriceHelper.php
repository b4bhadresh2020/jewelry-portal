<?php

namespace App\Traits\Helpers;

use App\ProductAttribute;

trait ProductPriceHelper
{
    public function benefitInValue()
    {
        return $this->mrp - $this->sell_price;
    }

    public function benefitInPercentage($noOfFloatingPoint = 2)
    {
        $percentage = 100 - (($this->sell_price * 100) / $this->mrp);
        return number_format((float) $percentage, $noOfFloatingPoint, '.', '');
    }

    public function isBenefit(): bool
    {
        return ($this->mrp > $this->sell_price);
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
