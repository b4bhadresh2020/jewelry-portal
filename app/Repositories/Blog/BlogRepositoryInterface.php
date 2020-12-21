<?php

namespace App\Repositories\Blog;

interface BlogRepositoryInterface
{
    public function store($attributes);

    public function update($attributes,$id);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();
}
