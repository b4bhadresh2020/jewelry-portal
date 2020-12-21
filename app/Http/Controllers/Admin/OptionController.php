<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionRequest;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Repositories\Option\OptionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OptionController extends Controller
{
    private $option, $attribute;

    public function __construct(
        OptionRepositoryInterface $option,
        AttributeRepositoryInterface $attribute
    ) {
        $this->option       = $option;
        $this->attribute    = $attribute;
    }

    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index(Request $request)
    {
        if (!userHasPermission('view-option')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/option", 'name' => "Option"],
        ];

        return view('admin.option.index', [
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
        if (!userHasPermission('add-option')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/option", 'name' => "Option"],
            ['link' => "javascript:void(0)", 'name' => "Create"],
        ];

        $attributes = $this->attribute->findByStatus(true);

        return view('admin.option.create', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'attributes'    => $attributes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OptionRequest  $request
     * @return redirect
     */
    public function store(OptionRequest $request)
    {
        if (!userHasPermission('add-option')) return permissionsException();

        $option = $this->option->store($request);
        if ($option) {
            Session::flash('toast_success', 'Option Add Successfully!');
        }
        return redirect('admin/option/create');
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
        if (!userHasPermission('edit-option')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/option", 'name' => "Option"],
            ['link' => "javascript:void(0)", 'name' => "Edit"],
        ];

        // Get all user list
        $option     = $this->option->findById($id);
        $attributes = $this->attribute->findByStatus(true);

        return view('admin.option.edit', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'option'        => $option,
            'attributes'    => $attributes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *s
     * @param  OptionRequest $request
     * @param  int  $id
     * @return redirect
     */
    public function update(OptionRequest $request, $id)
    {
        if (!userHasPermission('edit-option')) return permissionsException();

        $option = $this->option->update($request, $id);
        if ($option) {
            Session::flash('toast_success', 'Option Update Successfully!');
        }
        return redirect('admin/option');
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
}
