<?php

namespace App\Traits;

trait LivewirePagination{
    public function gotoPage($page){
        $this->page = $page;
    }

    public function nextPage(){
        if($this->page) $this->page++;
    }

    public function previousPage(){
        if($this->page) $this->page--;
    }
}
