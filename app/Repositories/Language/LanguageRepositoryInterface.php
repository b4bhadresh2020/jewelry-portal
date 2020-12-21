<?php


namespace App\Repositories\Language;

interface LanguageRepositoryInterface{

    public function findAll();

    public function findActive();

    public function findFront();

    public function batchUpdate(array $attribute);
}
