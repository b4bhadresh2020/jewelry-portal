<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CollectionRequest;
use App\Repositories\Collection\CollectionRepositoryInterface;
use Illuminate\Support\Facades\Session;

class CollectionController extends Controller
{
    private $collection;

    public function __construct(CollectionRepositoryInterface $collection)
    {
        $this->collection = $collection;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-collection')) return permissionsException();

        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/collection", 'name' => "Collection"],
        ];

        return view('admin.collection.index', [
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
        if (!userHasPermission('add-collection')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/collection", 'name' => "Collection"],
            ['name' => "Create"],
        ];

        return view('admin.collection.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Admin\CollectionRequest  $CollectionRequest
     * @return \Illuminate\Http\Response
     */
    public function store(CollectionRequest $request)
    {
        if (!userHasPermission('add-collection')) return permissionsException();

        $collection = $this->collection->store(['name' => $request->name]);
        if ($collection) {
            Session::flash('toast_success', 'Collection Add Successfully!');
        }
        return redirect('admin/collection/create');
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
        if (!userHasPermission('edit-collection')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/collection", 'name' => "Collection"],
            ['name' => "Edit"],
        ];
        $collection = $this->collection->findById($id);
        return view('admin.collection.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'collection' => $collection
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Admin\CollectionRequest  $CollectionRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CollectionRequest $request, $id)
    {
        if (!userHasPermission('edit-collection')) return permissionsException();

        $collection = $this->collection->update($id, ['name' => $request->name]);
        if ($collection) {
            Session::flash('toast_success', 'Collection Update Successfully!');
        }
        return redirect('admin/collection');
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
