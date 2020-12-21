<?php

namespace App\Repositories\Address;

interface AddressRepositoryInterface
{
    public function store(array $attributes);

    public function update($id, array $attributes);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();

    public function findByUserId($id);
}