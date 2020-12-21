<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!userHasPermission('view-customer')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/customer", 'name' => "Customers"],
        ];

        return view('admin.customer.index', [
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
        if (!userHasPermission('edit-customer')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/customer", 'name' => "Customers"],
            ['link' => "javascript:void(0)", 'name' => "Edit"],
        ];

        $user = $this->user->findById($id);

        return view('admin.customer.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
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
        if (!userHasPermission('edit-customer')) return permissionsException();

        $attributes = $request->only('first_name', 'last_name', 'phone', 'email');
        $this->user->update($id, $attributes);
        Session::flash('toast_success', 'Customer Details Update Successfully!');
        return redirect('admin/customer');
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
        Session::flash('toast_success', 'Customer Delete Successfully!');
        return redirect('admin/customer');
    }

    public function updateChange($id, $status)
    {
        $attributes = [
            'status' => $status
        ];
        if ($this->user->updateStatus($id, $attributes)) {
            if ($status == 1) {
                Session::flash('toast_success', "Customer Active Successfully");
            } else {
                Session::flash('toast_success', "Customer Block Successfully");
            }
        }
        return redirect()->back();
    }
}
