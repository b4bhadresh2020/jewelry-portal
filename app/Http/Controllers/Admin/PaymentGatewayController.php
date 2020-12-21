<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PaymentGatewayRequest;
use App\Repositories\PaymentGateway\PaymentGatewayRepositoryInterface;
use Illuminate\Support\Facades\Session;

class PaymentGatewayController extends Controller
{

    public function __construct(PaymentGatewayRepositoryInterface $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-payment-gateway')) return permissionsException();

        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/payment-gateway", 'name' => "Payment Gateway"],
        ];

        return view('admin.payment-gateway.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userHasPermission('add-payment-gateway')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['name' => "Create"],
        ];

        return view('admin.payment-gateway.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentGatewayRequest $request)
    {
        if (!userHasPermission('add-payment-gateway')) return permissionsException();

        $this->paymentGateway->store($request->all());
        Session::flash('toast_success', 'Payment Gateway Add Successfully!');
        return redirect('admin/payment-gateway/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!userHasPermission('edit-payment-gateway')) return permissionsException();

        $paymentGateway = $this->paymentGateway->findById($id);

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/payment-gateway", 'name' => "Payment Gateway"],
            ['name' => "Edit"],

        ];

        return view('admin.payment-gateway.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'paymentGateway' => $paymentGateway
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentGatewayRequest $request, $id)
    {
        if (!userHasPermission('edit-payment-gateway')) return permissionsException();

        if ($this->paymentGateway->update($id, $request->all())) {
            Session::flash('toast_success', 'Payment Gateway Update Successfully!');
        }
        return redirect('admin/payment-gateway');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePaymentGatewayStatus(Request $request)
    {
        $paymentGateway = $this->paymentGateway->paymentGatewayStatusUpdate($request->id);
        return $paymentGateway;
    }
}
