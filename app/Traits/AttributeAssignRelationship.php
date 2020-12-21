<?php

namespace App\Traits;

use App\Attribute;
use App\AttributeAssign;
use App\Media;

trait AttributeAssignRelationship
{
    /**
     * @return AttributeAssign
     */
    public function attributeAssign()
    {
        return $this->morphMany(AttributeAssign::class, 'categoryable');
    }
}
