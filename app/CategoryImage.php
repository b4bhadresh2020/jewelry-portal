<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryImage extends Model
{
    protected $guarded  = [];
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}