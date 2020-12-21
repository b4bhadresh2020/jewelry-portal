<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FaqRequest;
use App\Repositories\FaqCategory\FaqCategoryRepositoryInterface;
use App\Repositories\Faq\FaqRepositoryInterface;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{

    private $faq;
    private $faqCategory;

    public function __construct(FaqRepositoryInterface $faq, FaqCategoryRepositoryInterface $faqCategory)
    {
        $this->faq = $faq;
        $this->faqCategory = $faqCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-faq-information')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/faq", 'name' => "Faq Information"]
        ];

        return view('admin.faq.index', [
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
        if (!userHasPermission('add-faq-information')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/faq", 'name' => "Faq Information"],
        ];
        $faqCategory = $this->faqCategory->findByStatus(true);
        return view('admin.faq.create', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'faqCategory' => $faqCategory
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FaqRequest  $request
     * @return \Illuminate\Http\FaqRequest
     */
    public function store(FaqRequest $request)
    {
        if (!userHasPermission('add-faq-information')) return permissionsException();

        if ($this->faq->store($request->all())) {
            Session::flash('toast_success', 'Faq Information Add Successfully!');
        }
        return redirect('admin/faq/create');
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
        if (!userHasPermission('edit-faq-information')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/faq", 'name' => "faq Category"],
            ['name' => "Edit"],
        ];

        $faqCategory = $this->faqCategory->findByStatus(true);
        $faq = $this->faq->findById($id);

        return view('admin.faq.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'faqCategory'    => $faqCategory,
            'faq' => $faq,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FaqRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\FaqRequest
     */
    public function update(FaqRequest $request, $id)
    {
        if (!userHasPermission('edit-faq-information')) return permissionsException();

        if ($this->faq->update($id, $request->all())) {
            Session::flash('toast_success', 'Faq Information Update Successfully!');
        }
        return redirect('admin/faq');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!userHasPermission('delete-faq-information')) return permissionsException();

        $this->faq->delete($id);
        Session::flash('toast_success', 'Faq Information Delete Successfully!');
        return redirect('admin/faq');
    }
}
