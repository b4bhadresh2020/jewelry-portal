<?php


namespace App\Repositories\SubCategory;

interface SubCategoryRepositoryInterface
{

    public function findAll();

    public function findByStatus($status);

    public function findById($id);

    public function store($request);

    public function update($request, $id);

    public function filterWithPaginate();

    public function findSubCategoryByCategoryId($categoryId);

    public function countByCategoryId($categoryId);

    public function changeStatus($id, $status);

    public function findBySlug(string $slug);
}
