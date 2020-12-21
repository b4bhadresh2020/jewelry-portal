<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Subscriber\SubScriberRepositoryInterface;
use Illuminate\Support\Facades\Session;

class SubScriberController extends Controller
{

    private $subScriber;

    public function __construct(SubScriberRepositoryInterface $subScriber)
    {

        $this->subScriber = $subScriber;
    }

    public function index()
    {
        if (!userHasPermission('view-subscriber')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/subscriber-list", 'name' => "Subscriber"],

        ];
        return view('admin.subscriber.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
        ]);
    }

    public function destroy($id)
    {
        return permissionsException();

        if ($this->subScriber->delete($id)) {
            Session::flash('toast_success', 'Subscriber Delete Successfully!');
        }
        return redirect('admin/subscriber-list');
    }
}
