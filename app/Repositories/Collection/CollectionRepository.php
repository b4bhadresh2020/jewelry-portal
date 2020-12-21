<?php

namespace App\Repositories\Collection;

use App\Repositories\Collection\CollectionRepositoryInterface;
use App\Collection;

class CollectionRepository implements CollectionRepositoryInterface
{
    /**
     * @param array $attributes
     * @return
     */
    public function store(array $attributes)
    {
        $collection = Collection::create($attributes);
        return $collection;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return
     */
    public function update($id, array $attributes)
    {
        $collection = $this->findById($id)->update($attributes);
        return $collection;
    }

    /**
     * @return
     */
    public function findAll()
    {
        return Collection::all();
    }

    /**
     * @return
     */
    public function findById($id)
    {
        return Collection::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = false)
    {
        if ($forceDelete) {
            return $this->findById($id)->forceDelete();
        } else {
            return $this->findById($id)->delete();
        }
    }

    /**
     * @return
     */
    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return Collection::paginate($items);
    }
}
