<?php


namespace App\Repositories\User;

interface UserRepositoryInterface
{

    public function store(array $attributes);

    public function update($userId, array $attributes);

    public function findById($userId);

    public function findByEmail($email);

    public function delete($userId, $forceDelete = false);

    public function filterWithPaginate();

    public function customerLogin($attributes);

    public function findByStatus($status);

    public function storeSocialite(array $attributes);

    public function findBySocialiteProviderAndId($provider, $providerId);

    public function changeAuthUserPassword($newPassword);

    public function userHasDefaultAddress($id);

    public function linkSend($request);

    public function updateStatus($userId,array $attributes);

}
