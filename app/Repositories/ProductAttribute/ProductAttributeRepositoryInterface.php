<?php

namespace App\Repositories\ProductAttribute;

interface ProductAttributeRepositoryInterface
{
    public function store(array $attributes);

    public function update($id, array $attributes);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();

    public function changeStatus($id, $status);

    public function findBySku($sku);
}
