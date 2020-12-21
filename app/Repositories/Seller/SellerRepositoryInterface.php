<?php

namespace App\Repositories\Seller;

interface SellerRepositoryInterface
{
    public function store($request);

    public function update($request, $id);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();

    public function changeStatus($id, $status);

    public function  findByPublishSeller();
}