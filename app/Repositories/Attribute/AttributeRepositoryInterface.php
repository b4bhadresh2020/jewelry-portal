<?php

namespace App\Repositories\Attribute;

interface AttributeRepositoryInterface
{
    public function store($request);

    public function findById($id);

    public function update($request, $id);

    public function filterWithPaginate();

    public function findByStatus($status);

    public function findByCategoryId($category_id);

    public function findBySubCategoryId($sub_category_id);

    public function assignAttribute($request);

    public function findAssignAttributeByCategory($category_id);

    public function findAssignAttributeBySubCategory($sub_category_id);

    public function reorderAttribute($request);
}
