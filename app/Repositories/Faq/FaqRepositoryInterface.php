<?php

namespace App\Repositories\Faq;

interface FaqRepositoryInterface
{
    public function store(array $attributes);

    public function update($id,$attributes);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();

    public function deleteFaqByCategoryId($id);


}
