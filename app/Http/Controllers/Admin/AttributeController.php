<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeRequest;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeController extends Controller
{
    private $attribute;

    public function __construct(AttributeRepositoryInterface $attribute)
    {
        $this->attribute = $attribute;
    }


    public function reorderAttribute(Request $request)
    {
        $attribute = $this->attribute->reOrderAttribute($request);
        if ($attribute) {
            return ' Attribute Ordering update successfully!|***|update';
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index(Request $request)
    {
        if (!userHasPermission('view-attribute')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/attribute", 'name' => "Attributes"],
        ];

        return view('admin.attribute.index', [
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
        if (!isDeveloper()) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/attribute", 'name' => "Attributes"],
            ['name' => "Create"],
        ];

        return view('admin.attribute.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AttributeRequest  $request
     * @return redirect
     */
    public function store(AttributeRequest $request)
    {
        if (!isDeveloper()) return permissionsException();

        if (@$this->attribute->store($request)) {
            Session::flash('toast_success', 'Attribute Add Successfully!');
        } else {
            Session::flash('toast_error', 'Attribute Can\'t Add!');
        }
        return redirect('admin/attribute/create');
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
        if (!userHasPermission('edit-attribute')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/attribute", 'name' => "Attributes"],
            ['name' => "Edit"],
        ];

        $attribute = $this->attribute->findById($id);

        return view('admin.attribute.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'attribute'   => $attribute
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AttributeRequest  $request
     * @param  int  $id
     * @return redirect
     */
    public function update(AttributeRequest $request, $id)
    {
        if (!userHasPermission('edit-attribute')) return permissionsException();

        if (@$this->attribute->update($request, $id)) {
            Session::flash('toast_success', 'Attribute Update Successfully!');
        } else {
            Session::flash('toast_error', 'Attribute Can\'t Update!');
        }
        return redirect('admin/attribute');
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
}
