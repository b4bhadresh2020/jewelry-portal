<?php

namespace App\Repositories\Subscriber;

interface SubScriberRepositoryInterface
{

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();
}
