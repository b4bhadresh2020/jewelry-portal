<?php

namespace App\Repositories\MyFacker;

interface MyFackerRepositoryInterface
{
    public function items(int $times);

    public function homeBlog();

    public function homeTestimonial();

    public function homeCommonProduct();
}
