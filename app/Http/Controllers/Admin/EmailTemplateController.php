<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Repositories\Email\EmailTemplateRepositoryInterface;
use Illuminate\Support\Facades\Session;

class EmailTemplateController extends Controller
{

    private $emailTemplate;

    public function __construct(EmailTemplateRepositoryInterface $emailTemplate)
    {
        $this->emailTemplate = $emailTemplate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-email-template')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/email", 'name' => "Email Templates"],
        ];

        // Get all user list
        return view('admin.email.index', [
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
        if (!userHasPermission('add-email-template')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/email", 'name' => "Email Templates"],
            ['name' => "Create"],
        ];
        $shortCode = $this->emailTemplate->shortCodeArr();
        return view('admin.email.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'shortCode' => $shortCode
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!userHasPermission('add-email-template')) return permissionsException();

        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'content' => 'required',
        ]);
        $this->emailTemplate->store($request->all());
        Session::flash('toast_success', 'Email Tepmplates Add Successfully!');
        return redirect('admin/email/create');
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
        if (!userHasPermission('edit-email-template')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/email", 'name' => "email-template"],
            ['name' => "Edit"],
        ];

        $shortCode = $this->emailTemplate->shortCodeArr();
        $emailTemplate = $this->emailTemplate->findById($id);
        return view('admin.email.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'emailTemplate'    => $emailTemplate,
            'shortCode' => $shortCode

        ]);
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
        if (!userHasPermission('edit-email-template')) return permissionsException();

        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'content' => 'required',
        ]);
        $emailTemplate = $this->emailTemplate->update($request, $id);
        if ($emailTemplate) {
            Session::flash('toast_success', 'Email Template Update Successfully!');
        }
        return redirect('admin/email');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $email = $this->emailTemplate->delete($id);
        Session::flash('toast_success', 'Email Template delete Successfully!');
        return redirect('admin/email');
    }

    public function emailDetails(Request $request)
    {
        $email = $this->emailTemplate->findById($request->id);
        echo '<div class="ml-2">' . $email->content . '</div>';
    }
}
