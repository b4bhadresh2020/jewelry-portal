<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CustomSubCategoryRequest;
use App\Repositories\CustomCategory\CustomCategoryRepositoryInterface;
use App\Repositories\CustomSubCategory\CustomSubCategoryRepositoryInterface;
use App\CustomCategory;
use Illuminate\Support\Facades\Session;


class CustomSubCategoryController extends Controller
{

    private $customSubCategory, $customCategory;

    public function __construct(
        CustomSubCategoryRepositoryInterface $customSubCategory,
        CustomCategoryRepositoryInterface $customCategory
    ) {
        $this->customSubCategory = $customSubCategory;
        $this->customCategory = $customCategory;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!userHasPermission('view-custom-sub-category')) return permissionsException();

        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
        ];

        $customCategories = $this->customCategory->findByStatus(CustomCategory::PUBLISH);
        return view('admin.custom-sub-category.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'customCategories'    => $customCategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userHasPermission('add-custom-sub-category')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['name' => "Create"],
        ];
        $customCategories = $this->customCategory->findByStatus(CustomCategory::PUBLISH);
        return view('admin.custom-sub-category.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'customCategories'    => $customCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomSubCategoryRequest $request)
    {
        if (!userHasPermission('add-custom-sub-category')) return permissionsException();

        $customSubCategory = $this->customSubCategory->store($request);
        if ($customSubCategory) {
            Session::flash('toast_success', 'Custom Sub Category Add Successfully!');
        }
        return redirect('admin/custom-sub-category/create');
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
        if (!userHasPermission('edit-custom-sub-category')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['name' => "Edit"],
        ];

        // Get all user list
        $customSubCategory    = $this->customSubCategory->findById($id);
        $customCategories     = $this->customCategory->findByStatus(CustomCategory::PUBLISH);

        return view('admin.custom-sub-category.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'customSubCategory'   => $customSubCategory,
            'customCategories'    => $customCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomSubCategoryRequest $request, $id)
    {
        if (!userHasPermission('edit-custom-sub-category')) return permissionsException();

        $customSubCategory = $this->customSubCategory->update($id, $request->all());
        if ($customSubCategory) {
            Session::flash('toast_success', 'Custom Sub Category Update Successfully!');
        }
        return redirect('admin/custom-sub-category');
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

        if ($this->customSubCategory->changeStatus($id, $status)) {
            Session::flash('toast_success', 'Custom Sub Category Status Changed!');
        }
        return redirect()->back();
    }
}
