<?php

namespace App;

use App\Traits\MediaRelationship;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Service extends Model implements TranslatableContract
{
    public $translatedAttributes = ['title', 'description'];
    use Translatable, MediaRelationship, SoftDeletes;

    protected $guarded  = [];
}