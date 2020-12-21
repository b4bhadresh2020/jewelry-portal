<?php

namespace App\Repositories\Banner;

interface BannerRepositoryInterface
{
    public function store($request);

    public function seederStore($attributes);

    public function update($id, $request);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function reOrderBanner($request);
}
