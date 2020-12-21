<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BlogRequest;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    private $blog;

    public function __construct(BlogRepositoryInterface $blog)
    {
        $this->blog = $blog;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-blog')) return permissionsException();

        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/blog", 'name' => "Blog"],

        ];

        return view('admin.blog.index', [
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
        if (!userHasPermission('add-blog')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/blog", 'name' => "Blog"],
            ['name' => "Create"],
        ];

        return view('admin.blog.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\BlogRequest  $BlogRequest
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        if (!userHasPermission('add-blog')) return permissionsException();

        $blog = $this->blog->store($request);
        if ($blog) {
            Session::flash('toast_success', 'Blog Add Successfully!');
        }
        return redirect('admin/blog/create');
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
        if (!userHasPermission('edit-blog')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/blog", 'name' => "Blog"],
            ['name' => "Edit"],
        ];

        return view('admin.blog.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'blog' => $this->blog->findById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\BlogRequest  $BlogRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        if (!userHasPermission('edit-blog')) return permissionsException();

        $blog = $this->blog->update($request, $id);
        if ($blog) {
            Session::flash('toast_success', 'Blog Update Successfully!');
        }
        return redirect('admin/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!userHasPermission('delete-blog')) return permissionsException();

        if ($this->blog->delete($id)) {
            Session::flash('toast_success', 'Blog Delete Successfully!');
        }
        return redirect('admin/blog');
    }
}
