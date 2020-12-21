<?php

namespace App;

use App\Traits\Helpers\ProductPriceHelper;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use ProductPriceHelper;

    protected $guarded  = [];
}
