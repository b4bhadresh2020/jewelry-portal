<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_id', 'first_name', 'last_name','email','phone','message','reply','status'];
    protected $guarded  = [];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }


}
