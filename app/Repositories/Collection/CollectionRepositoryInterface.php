<?php

namespace App\Repositories\Collection;

interface CollectionRepositoryInterface
{
    public function store(array $attributes);

    public function update($id, array $attributes);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();
}
