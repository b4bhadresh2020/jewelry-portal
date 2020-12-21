<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserMenuRequest;
use App\Repositories\UserMenu\UserMenuRepositoryInterface;
use App\UserMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserMenuController extends Controller
{

    private $userMenu;

    public function __construct(UserMenuRepositoryInterface $userMenu)
    {
        $this->userMenu = $userMenu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-user-menu')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/user-menu", 'name' => "User Menu"],
            ['name' => "User Menu"],
        ];

        $userMenu = $this->userMenu->findByOrderWithLevelOne();

        return view('admin.user-menu.index', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'userMenu' => $userMenu
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userHasPermission('add-user-menu')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/user-menu", 'name' => "User Menu"],
            ['name' => "Create"],
        ];

        return view('admin.user-menu.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  app\Http\Requests\Admin\UserMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserMenuRequest $request)
    {
        if (!userHasPermission('add-user-menu')) return permissionsException();

        $this->userMenu->store($request);
        Session::flash('toast_success', 'User Manu Add Successfully!');
        return redirect()->back();
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
        if (!userHasPermission('edit-user-menu')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/user-menu", 'name' => "User Menu"],
            ['name' => "Edit"],
        ];

        $userMenu = $this->userMenu->findById($id);
        return view('admin.user-menu.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'userMenu' => $userMenu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserMenuRequest $request, $id)
    {
        if (!userHasPermission('edit-user-menu')) return permissionsException();

        $this->userMenu->update($id, $request);
        Session::flash('toast_success', 'User Manu Edit Successfully!');
        return redirect('admin/user-menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return permissionsException();

        $this->userMenu->delete($id);
        Session::flash('toast_success', 'User Manu Delete Successfully!');
        return redirect()->back();
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateManuOrder(Request $request)
    {
        if (!$this->userMenu->manageOrder($request)) {
            Session::flash('toast_error', 'Only three leval are allow !');
        }
        return redirect()->back();
    }
}
