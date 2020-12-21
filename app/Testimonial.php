<?php

namespace App;

use App\Traits\MediaRelationship;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Testimonial extends Model
{
    use Translatable, MediaRelationship;

    public $translatedAttributes = ['name', 'role', 'description'];
    protected $guarded  = [];
}
