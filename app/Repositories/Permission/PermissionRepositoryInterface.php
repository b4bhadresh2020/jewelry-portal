<?php

namespace App\Repositories\Permission;

interface PermissionRepositoryInterface
{
    public function store($request);

    public function update($id, $request);

    public function delete($id, $forceDelete = false);

    public function findAllGroup();

    public function findAllPermission();

    public function count($type);

    public function findAssignGroupId($id);

    public function formatAll();
}
