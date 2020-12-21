<?php

namespace App\Repositories\Product;

use Illuminate\Http\Request;

interface ProductRepositoryInterface
{
    public function store(array $attributes);

    public function update($id, array $attributes);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();

    public function findAllStatus();

    public function saveProductDetail(array $attributes);

    public function saveProductVariation(array $attributes);

    public function saveDefaultProduct(array $attributes);

    public function findDefaultAttributeBySlug(string $slug);

    public function findByStatus();

    public function applyFilter(Request $request);

    public function findByCategoryId($categoryId);

    public function productReview($request);

    public function findBySubCategoryId($request);

    public function countFindByCategoryId($categoryId);

    public function countFindBySubCategoryId($subCategoryId);
}
