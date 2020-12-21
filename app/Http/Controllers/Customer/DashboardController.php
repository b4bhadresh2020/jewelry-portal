<?php

namespace App\Http\Controllers\Customer;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AddAddressRequest;
use App\Http\Requests\Customer\ChangePasswordRequest;
use App\Http\Requests\Customer\ProfileUpdateRequest;
use App\Repositories\User\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('customer.dashboard.index', [
            'activeSidebar' => "dashboard"
        ]);
    }

    public function profile(ProfileUpdateRequest $request)
    {
        if (strtoupper($request->method()) === "POST") {
            $this->user->update(Auth::id(), $request->except('_token'));
            return redirect()->back()->with('toast_success', 'Profile change successfully..');
        }
        $countries = Country::select('id', 'name')->where('flag', 1)->get();
        return view('customer.dashboard.profile', [
            'activeSidebar' => "profile",
            'countries'     => $countries
        ]);
    }

    public function changePassword()
    {
        return view('customer.dashboard.changepassword', [
            'activeSidebar' => "change-password",
        ]);
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        $msg  = (auth()->user()->password) ? "Password Change Successfully" : "Password Set Successfully";
        if (Hash::check($request->oldpassword, auth()->user()->password) || !auth()->user()->password) {
            $this->user->changeAuthUserPassword($request->password);
            return redirect()->back()->with('toast_success', $msg);
        } else {
            return redirect()->back()->with('oldpassword', "The oldpassword field is invalid.");
        }
    }

    public function orders()
    {
        return view('customer.dashboard.orders', [
            'activeSidebar' => "orders"
        ]);
    }
}
