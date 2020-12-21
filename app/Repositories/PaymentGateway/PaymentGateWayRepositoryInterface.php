<?php

namespace App\Repositories\PaymentGateway;

interface PaymentGateWayRepositoryInterface
{
    public function store($request);

    public function update($id, $request);

    public function findAll();

    public function findById($id);

    public function delete($id, $forceDelete = false);

    public function filterWithPaginate();

    public function chnageStatusByPaymentGetwayName($name, $id, $status);

    public function paymentGatewayStatusUpdate($id);
}