<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Junges\ACL\Http\Models\Group;
use Junges\ACL\Http\Models\Permission;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(PermissionRepositoryInterface $permission)
    {
        $this->permission = $permission;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasAnyPermission('view-group', 'add-group', 'edit-group', 'delete-group')) {
            return permissionsException();
        }

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/permission", 'name' => "Manage Group"],
        ];

        $list = $this->permission->formatAll();
        return view('admin.permission.index', [
            "pageConfigs"           => $pageConfigs,
            "breadcrumbs"           => $breadcrumbs,
            "groups"                => $this->permission->findAllGroup(),
            "skipPermissionInList"  => $list['skipPermissionInList'],
            "actions"               => $list['actions'],
            "crudPermission"        => $list['crudPermission'],
            "otherPermission"       => $list['otherPermission'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!userHasPermission('add-group')) {
            return permissionsException();
        }

        if ($this->permission->count(2) !== 0) {
            if ($request->has('permission')) {
                $this->permission->store($request);
                return redirect()->back()->with("toast_success", "New Permission Successfully Added");
            } else {
                return redirect()->back()->with("toast_error", "Please Select Permission");
            }
        } else {
            return redirect()->back()->with("toast_error", "Permission List Not Found");
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!userHasPermission('edit-group')) {
            return permissionsException();
        }

        $this->permission->update($id, $request);
        return redirect()->back()->with("success", "Permission Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!userHasPermission('delete-group')) {
            return permissionsException();
        }
        $this->permission->delete($id);
        return redirect()->back()->with("toast_success", "Group Successfully Deleted");
    }
}
