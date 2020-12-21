<?php

namespace App\Repositories\PaymentGateway;

use App\Repositories\PaymentGateway\PaymentGateWayRepositoryInterface;
use App\PaymentGateWay;


class PaymentGateWayRepository implements PaymentGateWayRepositoryInterface
{
    /**
     * @param array $request
     * @return PaymentGateWay
     */
    public function store($request)
    {
        return PaymentGateWay::create($request);
    }

    /**
     * @param int $id
     * @param array $request
     * @return boolean
     */
    public function update($id, $request)
    {
        return  $this->findById($id)->update($request);
    }

    /**
     * @return PaymentGateWay
     */
    public function findAll()
    {
        return PaymentGateWay::all();
    }

    /**
     * @return PaymentGateWay
     */
    public function findById($id)
    {
        return PaymentGateWay::find($id);
    }

    /**
     * @param int $id
     * @param boolean $forceDelete
     * @return boolean
     */
    public function delete($id, $forceDelete = false)
    {
        if ($forceDelete) {
            return $this->findById($id)->forceDelete();
        } else {
            return $this->findById($id)->delete();
        }
    }

    /**
     * @return PaymentGateWay
     */
    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return PaymentGateWay::paginate($items);
    }

    public function chnageStatusByPaymentGetwayName($name, $id, $status)
    {
        return PaymentGateWay::where('id', '!=', $id)->where('name', $name)->update(['status' => $status]);
    }

    public function paymentGatewayStatusUpdate($id)
    {
        $paymentGateway = $this->findById($id);
        if ($paymentGateway->status == 0) {
            $this->findById($id)->update(['status' => 1]);
            $paymentGateways = $this->chnageStatusByPaymentGetwayName($paymentGateway->name, $id, 0);
            return $paymentGateways;
        }
        if ($paymentGateway->status == 1) {
            $this->findById($id)->update(['status' => 0]);
            $paymentGateways = $this->chnageStatusByPaymentGetwayName($paymentGateway->name, $id, 1);
            return $paymentGateways;
        }
    }
}