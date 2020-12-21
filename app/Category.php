<?php

namespace App;

use App\Traits\MediaRelationship;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\SubCategory;
use App\Traits\AttributeAssignRelationship;
use Spatie\Activitylog\Traits\LogsActivity;


class Category extends Model implements TranslatableContract
{
    use Translatable, MediaRelationship, AttributeAssignRelationship, LogsActivity;

    public $translatedAttributes = ['name', 'description'];
    protected $guarded  = [];

    const PUBLISH = 1;
    const ARCHIVE = 2;

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function categoryImage()
    {
        return $this->hasMany(CategoryImage::class)->where('type', 'category');
    }

    public function bannerImage()
    {
        return $this->hasMany(CategoryImage::class)->where('type', 'banner');
    }

    public function offerImage()
    {
        return $this->hasMany(CategoryImage::class)->where('type', 'offer');
    }

    # Below Code For Activity Log
    protected static function boot()
    {
        static::saving(function () {
            $logName = config('activitylog.log_name.category', 'other');
        });
        parent::boot();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $msg = "";
        switch ($eventName) {
            case 'created':
                $msg = $this->name . " new category added.";
                break;
            case 'deleted':
                $msg = $this->name . " category deleted";
                break;
        }
        return $msg;
    }


    // Accessor & Mutator
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(" ", "-", strtolower($value));
    }
}
