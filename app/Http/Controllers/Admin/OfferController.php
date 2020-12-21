<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OfferRequest;
use App\Repositories\Offer\OfferRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{
    private $offer;


    public function __construct(OfferRepositoryInterface $offer)
    {
        $this->offer = $offer;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('view-offer')) return permissionsException();

        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/offer", 'name' => "Offer"],
        ];
        $offers = $this->offer->findAll();
        return view('admin.offer.index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'offers' => $offers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return permissionsException();

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/offer", 'name' => "Offer"],
            ['name' => "Create"],
        ];

        return view('admin.offer.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        return permissionsException();

        $offer = $this->offer->store($request);
        if ($offer) {
            Session::flash('toast_success', 'offer Add Successfully!');
        } else {
            Session::flash('toast_success', 'Only 6 offer Inserted!');
        }
        return redirect('admin/offer/create');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!userHasPermission('edit-offer')) return permissionsException();

        $offer = $this->offer->findById($id);
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['link' => "/admin/offer", 'name' => "Offer"],
            ['name' => "Edit"],

        ];

        return view('admin.offer.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'offer' => $offer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, $id)
    {
        if (!userHasPermission('edit-offer')) return permissionsException();

        if ($this->offer->update($id, $request)) {
            Session::flash('toast_success', 'Offer Update Successfully!');
        }
        return redirect('admin/offer');
    }



    public function changeOfferStatus(Request $request)
    {
        $offer = $this->offer->offerStatusUpdate($request->id);
        return $offer;
    }
}
