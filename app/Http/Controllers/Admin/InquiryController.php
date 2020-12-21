<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Inquiry\InquiryContactRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class InquiryController extends Controller
{

    private $inquiryContact;

    public function __construct(InquiryContactRepositoryInterface $inquiryContact)
    {
        $this->inquiryContact = $inquiryContact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-inquiry-contact')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "admin/inquiry-contact", 'name' => "Inquiry Contact"],
        ];
        return view('admin.InquiryContact.index', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
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
        //
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
        $inquiryContact = $this->inquiryContact->update($id, $request->all());
        if ($inquiryContact) {

            echo json_encode(array(
                'success' => true,
                'message' => 'Reply Send Successfully',
                'status' => 200
            ), 200);
        }
    }

    public function viewInquiryProduct()
    {
        if (!userHasPermission('view-inquiry-product')) return permissionsException();

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "admin/inquiry-product", 'name' => "Inquiry Product"],
        ];
        return view('admin.inquiryProduct.index', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
