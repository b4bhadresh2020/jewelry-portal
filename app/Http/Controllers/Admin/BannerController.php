<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Repositories\Banner\BannerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class BannerController extends Controller
{
    private $banner;


    public function __construct(BannerRepositoryInterface $banner)
    {
        $this->banner = $banner;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-banner')) return permissionsException();

        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/banner", 'name' => "Banner"],

        ];
        $banners = $this->banner->findAll();

        return view('admin.banner.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'banners' => $banners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userHasPermission('add-banner')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/banner", 'name' => "Banner"],
            ['name' => "Create"],
        ];

        return view('admin.banner.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\BannerRequest  $BannerRequest
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        if (!userHasPermission('add-banner')) return permissionsException();

        $this->banner->store($request);
        Session::flash('toast_success', 'Banner Add Successfully!');
        return redirect('admin/banner/create');
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
        if (!userHasPermission('edit-banner')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $banner = $this->banner->findById($id);

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/banner", 'name' => "Banner"],
            ['name' => "Edit"],
        ];

        return view('admin.banner.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\BannerRequest  $BannerRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        if (!userHasPermission('edit-banner')) return permissionsException();

        if ($this->banner->update($id, $request)) {
            Session::flash('toast_success', 'Banner Update Successfully!');
        }
        return redirect('admin/banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!userHasPermission('delete-banner')) return permissionsException();

        if ($this->banner->delete($id))
            Session::flash('toast_success', 'Banner delete Successfully!');

        return redirect('admin/banner');
    }

    public function reorderBanner(Request $request)
    {
        $banner = $this->banner->reOrderBanner($request);
        if ($banner) {
            return ' Banner Ordering update successfully!|***|update';
        }
    }
}
