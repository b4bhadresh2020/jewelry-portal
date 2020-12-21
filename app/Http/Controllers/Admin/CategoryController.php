<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    private $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        if (!userHasPermission('view-category')) return permissionsException();

        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/category", 'name' => "Category"],
        ];

        return view('admin.category.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return view
     */
    public function create()
    {
        if (!userHasPermission('add-category')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/category", 'name' => "Category"],
            ['name' => "Create"],
        ];

        return view('admin.category.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return redirect
     */
    public function store(CategoryRequest $request)
    {
        if (!userHasPermission('add-category')) return permissionsException();

        $this->category->store($request);
        Session::flash('toast_success', 'Category Add Successfully!');
        return redirect('admin/category/create');
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
        if (!userHasPermission('edit-category')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/category", 'name' => "Category"],
            ['name' => "Edit"],
        ];

        $category = $this->category->findById($id);

        return view('admin.category.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'category'    => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  int  $id
     * @return redirect
     */
    public function update(CategoryRequest $request, $id)
    {
        if (!userHasPermission('edit-category')) return permissionsException();

        if ($this->category->update($request, $id)) {
            Session::flash('toast_success', 'Category Update Successfully!');
        }
        return redirect('admin/category');
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
        if ($this->category->changeStatus($id, $status)) {
            Session::flash('toast_success', 'Category Status Changed!');
        }
        return redirect()->back();
    }
}
