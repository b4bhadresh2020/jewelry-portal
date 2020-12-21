<?php

namespace App;

use App\Traits\MediaRelationship;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Category;
use App\Traits\AttributeAssignRelationship;
use Spatie\Activitylog\Traits\LogsActivity;

class SubCategory extends Model implements TranslatableContract
{
    use Translatable, MediaRelationship, AttributeAssignRelationship, LogsActivity;

    public $translatedAttributes = ['name'];
    protected $guarded  = [];

    const PUBLISH = 1;
    const ARCHIVE = 2;

    /**
     * @return Category|null
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
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
                $msg = $this->name . " new sub category added.";
                break;
            case 'deleted':
                $msg = $this->name . " sub category deleted";
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
