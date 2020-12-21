<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{

    private $subCategory, $category;

    public function __construct(
        SubCategoryRepositoryInterface $subCategory,
        CategoryRepositoryInterface $category
    ) {
        $this->subCategory = $subCategory;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!userHasPermission('view-sub-category')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "#!", 'name' => "Catalog"],
            ['link' => "/admin/sub-category", 'name' => "Sub Categories"],
        ];

        $categories = $this->category->findByStatus(Category::PUBLISH);

        return view('admin.sub_category.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'categories'    => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userHasPermission('add-sub-category')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/sub-category", 'name' => "Sub Category"],
            ['link' => "javascript:void(0)", 'name' => "Create"],
        ];

        $categories = $this->category->findByStatus(Category::PUBLISH);

        return view('admin.sub_category.create', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'categories'    => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        if (!userHasPermission('add-sub-category')) return permissionsException();

        $subCategory = $this->subCategory->store($request);
        if ($subCategory) {
            Session::flash('toast_success', 'Sub Category Add Successfully!');
        }
        return redirect('admin/sub-category/create');
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
        if (!userHasPermission('edit-sub-category')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/sub-category", 'name' => "Sub Category"],
            ['link' => "javascript:void(0)", 'name' => "Edit"],
        ];

        // Get all user list
        $subCategory    = $this->subCategory->findById($id);
        $categories     = $this->category->findByStatus(Category::PUBLISH);

        return view('admin.sub_category.edit', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'subCategory'   => $subCategory,
            'categories'    => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *s
     * @param  SubCategoryRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
    {
        if (!userHasPermission('edit-sub-category')) return permissionsException();

        $subCategory = $this->subCategory->update($request, $id);
        if ($subCategory) {
            Session::flash('toast_success', 'Sub Category Update Successfully!');
        }
        return redirect('admin/sub-category');
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
        if ($this->subCategory->changeStatus($id, $status)) {
            Session::flash('toast_success', 'Category Status Changed!');
        }
        return redirect()->back();
    }
}
