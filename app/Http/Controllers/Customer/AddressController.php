<?php

namespace App\Http\Controllers\Customer;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AddAddressRequest;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public $activeSidebar, $address, $user;

    public function __construct(
        AddressRepositoryInterface $address,
        UserRepositoryInterface $user
    ) {
        $this->activeSidebar    = "addresses";
        $this->address          = $address;
        $this->user             = $user;
    }

    /**
     * Display a addresses.
     * @return view
     */
    public function index()
    {
        $userHasDefaultAddress = $this->user->userHasDefaultAddress(Auth::id());
        return view('customer.dashboard.address.index', [
            'activeSidebar'         => $this->activeSidebar,
            'userHasDefaultAddress' => $userHasDefaultAddress
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return view
     */
    public function create()
    {
        $countries = Country::select('id', 'name')->where('flag', 1)->get();
        return view('customer.dashboard.address.add', [
            'activeSidebar' => $this->activeSidebar,
            'countries'     => $countries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddAddressRequest $request
     * @return redirect|back
     */
    public function store(AddAddressRequest $request)
    {
        $request->merge(['user_id' => Auth::id()]);
        $this->address->store($request->except('_token', 'country_id'));
        return redirect()->back()->with('toast_success', 'Address added successfully..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return view
     */
    public function edit($id)
    {
        $address    = $this->address->findById($id);
        $countries  = Country::select('id', 'name')->where('flag', 1)->get();
        return view('customer.dashboard.address.edit', [
            'activeSidebar' => $this->activeSidebar,
            'countries'     => $countries,
            'address'       => $address
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  AddAddressRequest $request
     * @param  int  $id
     * @return redirect|back
     */
    public function update(AddAddressRequest $request, $id)
    {
        $request->merge(['user_id' => Auth::id()]);
        $this->address->update($id, $request->except('_token', 'country_id'));
        return redirect('dashboard/address')->with('toast_success', 'Address change successfully..');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return redirect|back
     */
    public function destroy($id)
    {
        $this->address->delete($id);
        return redirect()->back()->with('toast_success', 'Address remove successfully..');
    }
}