<?php

namespace App\Repositories\Option;

interface OptionRepositoryInterface
{
    public function findAll();

    public function findById($id);

    public function store($request);

    public function update($request, $id);

    public function filterWithPaginate();

    public function findByAttributeId($attribute_id);
}
