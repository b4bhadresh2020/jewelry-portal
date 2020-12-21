<?php

namespace App\Traits;

trait LivewireSort{

    public $sortField, $sortDirection;

    public function sort($sortField){
        $this->sortField        = $sortField;
        $this->sortDirection    = ($this->sortDirection == "DESC") ? "ASC" : "DESC";
    }
}
