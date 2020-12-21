<?php

namespace App\Http\Controllers\Admin;

use App\AppSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [];
        if (!userHasAnyPermission('general-setting', 'social-link-setting', 'homepage-setting')) {
            return permissionsException();
        }

        if (userHasPermission('homepage-setting')) {
            $data['oldHomaPageBatchList'] = AppSetting::findActiveHomeBlockList();
        }

        if (userHasPermission('social-link-setting')) {
            $data['oldLinksBatchList'] = AppSetting::findAllLinks();
        }

        return view('admin.app-setting.index', $data);
    }

    public function __general(Request $request)
    {
        if (!userHasPermission('general-setting')) return permissionsException();

        return redirect()->back()->with('toast_success', 'Save Successfully');
    }

    public function __socialLink(Request $request)
    {
        if (!userHasPermission('social-link-setting')) return permissionsException();

        if ($request->links) {
            foreach ($request->links as $key => $link) {
                AppSetting::updateOrCreate(
                    ['key' => $key, 'batch' => AppSetting::BATCH_SOCIAL_LINKS],
                    ['value' => $link]
                );
            }
        }

        return redirect()->back()->with('toast_success', 'Save Successfully');
    }

    public function __homePage(Request $request)
    {
        if (!userHasPermission('homepage-setting')) return permissionsException();

        if ($request->homepage) {
            foreach ($request->homepage as $key) {
                AppSetting::updateOrCreate(
                    ['key' => $key, 'batch' => AppSetting::BATCH_HOME_PAGE],
                    ['value' => AppSetting::ON]
                );
            }

            AppSetting::where('batch', AppSetting::BATCH_HOME_PAGE)
                ->whereNotIn('key', array_keys($request->homepage))
                ->update(['value' => AppSetting::OFF]);
        } else {
            AppSetting::toggleHomeBlock(AppSetting::OFF);
        }
        return redirect()->back()->with('toast_success', 'Save Successfully');
    }
}
