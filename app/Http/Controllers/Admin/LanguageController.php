<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Language\LanguageRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Junges\ACL\Exceptions\UnauthorizedException;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $language;

    public function __construct(LanguageRepositoryInterface $language)
    {
        $this->language = $language;
    }

    public function index()
    {
        if (!userHasPermission('language-setting')) return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "javascript:void(0)", 'name' => "Settings"],
            ['link' => "/admin/language", 'name' => "Languages"],
        ];

        $languages = $this->language->findAll();
        return view('admin.language.index', [
            'languages' => $languages,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function store(Request $request)
    {
        if (!userHasPermission('language-setting')) return permissionsException();

        $attributes = $request->only(['name', 'is_visible', 'status', 'code']);
        $this->language->batchUpdate($attributes);

        Session::flash('toast_success', 'Languages Setting Change Successfully!');
        return redirect('admin/language');
    }
}
