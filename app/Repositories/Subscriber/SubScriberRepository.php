<?php

namespace App\Repositories\Subscriber;

use App\Repositories\Subscriber\SubScriberRepositoryInterface;
use App\Subscriber;


class SubScriberRepository implements SubScriberRepositoryInterface
{



    /**
     * @return
     */
    public function findAll(){
        return Subscriber::all();
    }

    /**
     * @return
     */
    public function findById($id){
        return Subscriber::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = true){
        if($forceDelete){
            return $this->findById($id)->forceDelete();
        }else{
            return $this->findById($id)->delete();
        }
    }

    /**
     * @return
     */
    public function filterWithPaginate(){
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return Subscriber::paginate($items);
    }
}
