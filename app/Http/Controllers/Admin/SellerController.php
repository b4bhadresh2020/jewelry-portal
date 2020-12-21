<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SellerRequest;
use App\Repositories\Seller\SellerRepositoryInterface;
use App\Seller;
use Illuminate\Http\Request;
use Session;

class SellerController extends Controller
{
    private $seller;

    public function __construct(SellerRepositoryInterface $seller)
    {
        $this->seller = $seller;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/seller", 'name' => "Seller"],
        ];

        return view('admin.seller.index', [
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
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['name' => "Create"],
        ];

        return view('admin.seller.create', [
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
    public function store(SellerRequest $request)
    {
        $this->seller->store($request);
        Session::flash('toast_success', 'Seller Add Successfully!');
        return redirect('admin/seller/create');
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
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['name' => "Edit"],
        ];
        $seller = $this->seller->findById($id);
        return view('admin.seller.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'seller'    => $seller
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SellerRequest $request, $id)
    {
        if ($this->seller->update($request, $id)) {
            Session::flash('toast_success', 'Seller Update Successfully!');
        }
        return redirect('admin/seller');
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

    public function changeStatus($id, $status)
    {
        if ($this->seller->changeStatus($id, $status)) {
            Session::flash('toast_success', 'Seller Status Changed!');
        }
        return redirect()->back();
    }
}