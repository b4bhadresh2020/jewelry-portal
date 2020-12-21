<?php

namespace App\Repositories\UserMenu;

interface UserMenuRepositoryInterface
{
    public function store($request);

    public function update($id, $request);

    public function findAll();

    public function findById($id);

    public function delete($id);

    public function findByOrderWithLevelOne($sortDirection = "ASC");

    public function manageOrder($request);
}
