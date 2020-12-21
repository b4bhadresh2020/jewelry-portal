<?php

namespace App\Repositories\Inquiry;

interface InquiryContactRepositoryInterface
{
    public function store($request);


    public function update($id, array $attributes);


    public function findById($id);


    public function filterWithPaginate();
}
