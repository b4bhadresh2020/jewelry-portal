<?php

namespace App\Repositories\Offer;

interface OfferRepositoryInterface
{
    public function store($attributes);

    public function update($id,$attributes);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();

    public function offerStatusUpdate($id);
}
