<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    private $user, $permission;

    public function __construct(UserRepositoryInterface $user, PermissionRepositoryInterface $permission)
    {
        $this->user = $user;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!userHasPermission('view-user')) {
            return permissionsException();
        }

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/account", 'name' => "Accounts"],
        ];

        return view('admin.account.index', [
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
        if (!userHasPermission('add-user')) {
            return permissionsException();
        }

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/account", 'name' => "Accounts"],
            ['link' => "javascript:void(0)", 'name' => "Create"],
        ];

        return view('admin.account.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'groups'      => $this->permission->findAllGroup(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (!userHasPermission('add-user')) {
            return permissionsException();
        }

        $attributes = $request->only('first_name', 'last_name', 'phone', 'email', 'password');
        $attributes['type'] = User::BACKEND_USER;
        $this->user->store($attributes);
        Session::flash('toast_success', 'User Create Successfully!');
        return redirect('admin/account/create');
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
        if (!userHasPermission('edit-user')) {
            return permissionsException();
        }

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/account", 'name' => "Accounts"],
            ['link' => "javascript:void(0)", 'name' => "Edit"],
        ];

        $user = $this->user->findById($id);

        return view('admin.account.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'groupId' => $this->permission->findAssignGroupId($id),
            'groups'  => $this->permission->findAllGroup(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if (!userHasPermission('edit-user')) {
            return permissionsException();
        }

        $attributes = $request->only('first_name', 'last_name', 'phone', 'email', 'group');
        $this->user->update($id, $attributes);
        Session::flash('toast_success', 'User Details Update Successfully!');
        return redirect('admin/account');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->delete($id);
        Session::flash('toast_success', 'User Delete Successfully!');
        return redirect('admin/account');
    }

    public function updateChange($id, $status)
    {
        $attributes = [
            'status' => $status
        ];
        if ($this->user->updateStatus($id, $attributes)) {
            if ($status == 1) {
                Session::flash('toast_success', "User Active Successfully");
            } else {
                Session::flash('toast_success', "User Block Successfully");
            }
        }
        return redirect()->back();
    }

    public function profile(Request $request)
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/account", 'name' => "Profile"],
        ];

        if (strtoupper($request->method()) === "POST") {
            $this->user->update(Auth::id(), $request->except('_token'));
            return redirect()->back()->with('toast_success', 'Profile change successfully..');
        }

        return view('admin.account.account-edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function changePassword(Request $request)
    {
        if (Hash::check($request->oldpassword, auth()->user()->password)) {
            $this->user->changeAuthUserPassword($request->password);
            return [
                'status' => true,
                'msg' => 'Password Change Successfully',
            ];
        } else {
            return [
                'status' => false,
                'msg' => 'Old Password is wrong',
            ];
        }
    }
}
