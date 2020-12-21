<?php

namespace App\Repositories\CustomSubCategory;

interface CustomSubCategoryRepositoryInterface
{
    public function store($attributes);

    public function update($id, array $attributes);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();

    public function changeStatus($id, $status);
}
