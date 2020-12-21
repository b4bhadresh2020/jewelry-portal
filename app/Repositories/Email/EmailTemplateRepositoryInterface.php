<?php

namespace App\Repositories\Email;

interface EmailTemplateRepositoryInterface
{
    public function getModel();

    public function getAllWithPagination();

    public function getAllEmailTemplate();

    public function findById($id);

    public function delete($id);

    public function store($attributes);

    public function update($request, $id);

    public function getFilterWithPaginate();

    public function shortCodeArr();

}
