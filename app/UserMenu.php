<?php

namespace App;

use App\Traits\MediaRelationship;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class UserMenu extends Model implements TranslatableContract
{
    use Translatable, MediaRelationship;
    protected $guarded  = [];
    public $translatedAttributes = ['title'];

    public function submenu()
    {
        return $this->hasMany(self::class,'parent')->orderBy('order','ASC');
    }
}
