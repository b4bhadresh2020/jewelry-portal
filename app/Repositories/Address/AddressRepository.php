<?php

namespace App\Repositories\Address;

use App\Repositories\Address\AddressRepositoryInterface;
use App\Address;


class AddressRepository implements AddressRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Address
     */
    public function store(array $attributes)
    {
        $this->hashDefault($attributes);
        return Address::create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return boolean
     */
    public function update($id, array $attributes)
    {
        $address = $this->findById($id);
        $this->hashDefault($attributes, $address);
        return $address->update($attributes);
    }

    /**
     * @return Address
     */
    public function findAll()
    {
        return Address::all();
    }

    /**
     * @return Address
     */
    public function findById($id)
    {
        return Address::find($id);
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
     * @return Address
     */
    public function filterWithPaginate()
    {
    }


    /**
     * @param array $attributes
     */
    protected function hashDefault(array &$attributes, $address = null)
    {
        if (array_key_exists('is_default', $attributes)) {
            Address::where('user_id', $attributes['user_id'])->update([
                'is_default' => false
            ]);
            if ($address) {
                $attributes['is_default'] = true;
            }
        } else {
            if ($address) {
                $attributes['is_default'] = false;
            }
        }
    }

    /**
     * @return Address
     */
    public function findByUserId($id)
    {
        return Address::where('user_id', $id)
            ->get();
    }
}