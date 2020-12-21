<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FaqCategoryRequest;
use App\Repositories\FaqCategory\FaqCategoryRepositoryInterface;
use Illuminate\Support\Facades\Session;


class FaqCategoryController extends Controller
{

    private $faqCategory;

    public function __construct(FaqCategoryRepositoryInterface $faqCategory)
    {
        $this->faqCategory = $faqCategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-faq-category')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/faq-category", 'name' => "Faq Category"]
        ];

        return view('admin.faq-category.index', [
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
        if (!userHasPermission('add-faq-category')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/faq category", 'name' => "faq Category"],
            ['name' => "Create"],
        ];

        return view('admin.faq-category.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FaqCategoryRequest  $request
     * @return \Illuminate\Http\FaqCategoryRequest
     */
    public function store(FaqCategoryRequest $request)
    {
        if (!userHasPermission('add-faq-category')) return permissionsException();

        if ($this->faqCategory->store($request->all())) {
            Session::flash('toast_success', 'Faq Category Add Successfully!');
        }
        return redirect('admin/faq-category/create');
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
        if (!userHasPermission('edit-faq-category')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/faq category", 'name' => "faq Category"],
            ['name' => "Edit"],
        ];

        $faqCategory = $this->faqCategory->findById($id);

        return view('admin.faq-category.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'faqcategory'    => $faqCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FaqCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\FaqCategoryRequest
     */
    public function update(FaqCategoryRequest $request, $id)
    {
        if (!userHasPermission('edit-faq-category')) return permissionsException();

        if ($this->faqCategory->update($request->all(), $id)) {
            Session::flash('toast_success', 'faq Category Update Successfully!');
        }
        return redirect('admin/faq-category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!userHasPermission('delete-faq-category')) return permissionsException();

        if ($this->faqCategory->delete($id)) {
            Session::flash('toast_success', 'faq Category Delete Successfully!');
        }
        return redirect('admin/faq-category');
    }
}
