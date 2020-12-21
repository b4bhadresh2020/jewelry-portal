<?php

namespace App\Repositories\Service;

interface ServiceRepositoryInterface
{
    public function store($attributes);

    public function update($request, $id);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();
}
