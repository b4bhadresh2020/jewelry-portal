<?php

namespace App\Repositories\Discount;

interface DiscountRepositoryInterface
{
    public function store($request);

    public function findById($id);

    public function update($request, $id);

    public function filterWithPaginate();

    public function findByStatus($status);

    public function delete($id);

    public function changeStatus($id, $attributes);
}
