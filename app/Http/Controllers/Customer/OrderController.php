<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Discount;
use Auth;
use App\Repositories\Address\AddressRepositoryInterface;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function __construct(AddressRepositoryInterface $address)
    {
        $this->address = $address;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Page header set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
        ];

        return view('admin.{folder_name}.index', [
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
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['name' => "Create"],
        ];

        return view('admin.{folder_name}.create', [
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
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['link' => "/admin", 'name' => "Home"],
            ['name' => "Edit"],
        ];

        return view('admin.{folder_name}.edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
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
        //
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

    /**
     * Coupon code verify.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function applyCouponCode(Request $request)
    {
        $discounts =  Discount::selectRaw("discounts.*,discount_assigns.*")
            ->where('discount_type', 1)
            ->where('coupon_code', $request->coupon_code)
            ->join("discount_assigns", "discounts.id", "=", "discount_assigns.discount_id")
            ->where('discount_assigns_id', Auth::user()->id)
            ->where('discount_assigns_type', "App\User")
            ->where('from_date', "<=", date('Y-m-d'))
            ->where('to_date', ">=", date('Y-m-d'));

        $discounts = $discounts->get()->first();

        if (!empty($discounts)) {
            $discount['status'] = 1;
            $discount['discount'] = $discounts->amount;
            Session::put("discount", $discounts->amount);
        } else {
            $discount['discount'] = 0;
            $discount['status'] = 2;
            Session::put("discount", 0);
        }

        return $discount;
    }

    /**
     * Show checkout page.
     *
     */
    public function checkout()
    {
        $addresses = $this->address->findByUserId(Auth::id());

        return view('customer.product.checkout', [
            'addresses' => $addresses
        ]);
    }
}