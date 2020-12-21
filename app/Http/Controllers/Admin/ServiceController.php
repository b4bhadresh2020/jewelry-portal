<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use Illuminate\Http\Request;
use App\Repositories\Service\ServiceRepositoryInterface;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    private $service;

    public function __construct(ServiceRepositoryInterface $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-service')) return permissionsException();

        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/service", 'name' => "Services"],
        ];

        return view('admin.service.index', [
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
        if (!userHasPermission('add-service')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/service", 'name' => "Services"],
            ['name' => "Add New"],
        ];

        return view('admin.service.create', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        if (!userHasPermission('add-service')) return permissionsException();

        $service = $this->service->store($request);
        if ($service) {
            Session::flash('toast_success', 'Services Add Successfully!');
        }
        return redirect('admin/service/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!userHasPermission('edit-service')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/service", 'name' => "Services"],
            ['name' => "Edit"],
        ];

        $service = $this->service->findById($id);
        return view('admin.service.edit', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'service'    => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ServiceRequest  $request
     * @param  int  $id
     * @return redirect
     */
    public function update(ServiceRequest $request, $id)
    {
        if (!userHasPermission('edit-service')) return permissionsException();

        if ($this->service->update($request, $id)) {
            Session::flash('toast_success', 'Services Update Successfully!');
        }
        return redirect('admin/service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!userHasPermission('delete-service')) return permissionsException();

        $this->service->delete($id);
        Session::flash('toast_success', 'Services Delete Successfully!');
        return redirect('admin/service');
    }
}
