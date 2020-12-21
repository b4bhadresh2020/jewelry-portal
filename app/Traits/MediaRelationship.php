<?php

namespace App\Traits;

use App\Media;

trait MediaRelationship
{
    /**
     * @return Media
     */
    public function media(){
        return $this->morphOne(Media::class, 'mediable');
    }
}
