<?php

namespace App;

use App\Traits\MediaRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use  MediaRelationship, SoftDeletes;
    const PUBLISH = 1;
    const ARCHIVE = 2;
    protected $guarded  = [];
}