<?php

namespace App\Traits\Helpers;

use App\ProductAttribute;

trait ProductAttributeHelper
{
    public function isStockAvailable(): bool
    {
        return ($this->stock > 0);
    }
}
