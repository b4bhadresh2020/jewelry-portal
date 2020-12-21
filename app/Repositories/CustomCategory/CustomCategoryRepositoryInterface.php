<?php

namespace App\Repositories\CustomCategory;

interface CustomCategoryRepositoryInterface
{
    public function store($attributes);

    public function update($id, array $attributes);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();

    public function changeStatus($id, $status);

    public function findByStatus($status);
}
