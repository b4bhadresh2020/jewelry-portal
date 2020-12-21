<?php

namespace App\Repositories\Testimonial;

interface TestimonialRepositoryInterface
{
    public function store($request);

    public function update($request, $id);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();
}
