<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Repositories\Testimonial\TestimonialRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestimonialController extends Controller
{
    public $testimonial;

    public function __construct(TestimonialRepositoryInterface $testimonial)
    {
        $this->testimonial = $testimonial;
    }


    /**
     * Display a listing of the resource.
     * @return view
     */
    public function index()
    {
        if (!userHasPermission('view-testimonial')) return permissionsException();

        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/testimonial", 'name' => "Testimonials"],
        ];

        return view('admin.testimonial.index', [
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
        if (!userHasPermission('add-testimonial')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/testimonial", 'name' => "Testimonials"],
            ['name' => "Create"],
        ];

        return view('admin.testimonial.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return redirect
     */
    public function store(TestimonialRequest $request)
    {
        if (!userHasPermission('add-testimonial')) return permissionsException();

        $this->testimonial->store($request);
        Session::flash('toast_success', 'Testimonial Add Successfully!');
        return redirect('admin/testimonial/create');
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
        if (!userHasPermission('edit-testimonial')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/testimonial", 'name' => "Testimonials"],
            ['name' => "Edit"],
        ];

        $testimonial = $this->testimonial->findById($id);

        return view('admin.testimonial.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'testimonial' => $testimonial
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return redirect
     */
    public function update(TestimonialRequest $request, $id)
    {
        if (!userHasPermission('edit-testimonial')) return permissionsException();

        if ($this->testimonial->update($request, $id)) {
            Session::flash('toast_success', 'Testimonial Update Successfully!');
        }
        return redirect('admin/testimonial');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return redirect|back
     */
    public function destroy($id)
    {
        if (!userHasPermission('delete-testimonial')) return permissionsException();

        $this->testimonial->delete($id);
        Session::flash('toast_success', 'Testimonial Delete Successfully!');
        return redirect()->back();
    }
}
