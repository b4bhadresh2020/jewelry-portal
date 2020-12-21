<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomCategoryRequest;
use App\Repositories\CustomCategory\CustomCategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomCategoryController extends Controller
{

    private $customCategory;

    public function __construct(CustomCategoryRepositoryInterface $customCategory)
    {
        $this->customCategory = $customCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index(Request $request)
    {
        if (!userHasPermission('view-custom-category')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/custom-category", 'name' => "Custom Category"],
        ];

        return view('admin.custom-category.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return view
     */
    public function create()
    {
        if (!userHasPermission('add-custom-category')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/custom-category", 'name' => "Custom Category"],
            ['link' => "javascript:void(0)", 'name' => "Create"],
        ];

        return view('admin.custom-category.create', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CustomCategoryRequest  $request
     * @return redirect
     */
    public function store(CustomCategoryRequest $request)
    {
        if (!userHasPermission('add-custom-category')) return permissionsException();

        $this->customCategory->store($request);
        Session::flash('toast_success', 'Custom Category Add Successfully!');
        return redirect('admin/custom-category/create');
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
     * @return view
     */
    public function edit($id)
    {
        if (!userHasPermission('edit-custom-category')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/custom-category", 'name' => "Custom Category"],
            ['link' => "javascript:void(0)", 'name' => "Edit"],
        ];

        // Get all user list
        $customCategory     = $this->customCategory->findById($id);

        return view('admin.custom-category.edit', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'customCategory'        => $customCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *s
     * @param  CustomCategoryRequest $request
     * @param  int  $id
     * @return redirect
     */
    public function update(CustomCategoryRequest $request, $id)
    {
        if (!userHasPermission('edit-custom-category')) return permissionsException();

        $customCategory = $this->customCategory->update($id, $request->all());
        if ($customCategory) {
            Session::flash('toast_success', 'Custom Category Update Successfully!');
        }
        return redirect('admin/custom-category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function changeStatus($id, $status)
    {
        if ($this->customCategory->changeStatus($id, $status)) {
            Session::flash('toast_success', 'Custom Category Status Changed!');
        }
        return redirect()->back();
    }
}
