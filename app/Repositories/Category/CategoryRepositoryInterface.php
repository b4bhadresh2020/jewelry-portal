<?php


namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{

    public function store($request);

    public function findById($id);

    public function findAll();

    public function update($request, $id);

    public function filterWithPaginate();

    public function findByStatus($status);

    public function changeStatus($id, $status);

    public function findBySlug(string $slug);
}