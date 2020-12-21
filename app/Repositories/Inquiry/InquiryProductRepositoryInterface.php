<?php

namespace App\Repositories\Inquiry;

interface InquiryProductRepositoryInterface
{


    public function findById($id);


    public function filterWithPaginate();
}
