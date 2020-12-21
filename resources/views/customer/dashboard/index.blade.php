@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Dashboard')

{{-- defind style page level --}}
@section('page-style')
    <link href="{{asset('assets')}}/css/dashboard.css" rel="stylesheet" type="text/css"/>
@endsection

{{-- defind content --}}
@section('content')
    <section class="my-5">

        <div class="container">
            <div class="row">

                {{-- Dashboard Sidebar --}}
                @include('customer.layouts.dashboard-sidebar')

                <div class="col-lg-9 order-lg-last dashboard-content">
                    <div class="card frame">
                        <div class="frame card-header"><h3 class="title">My Dashboard</h3></div>
                        <div class="frame card-body">
                            @if(session('new_account'))
                                <div class="alert alert-success alert-intro" role="alert">
                                    Thank you for registering with Shivaay
                                </div>
                            @endif


                            @auth
                                @if (!auth()->user()->password)
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Your Account Password Not Set. Click To<a href="{{ url('dashboard/change-password') }}"> Set Password</a>!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @endif
                            @endauth

                            <div class="alert alert-success" role="alert">
                                Hello, <strong>Shivaay customer!</strong> From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.
                            </div>

                            <div class="mb-4"></div>

                            <h4 class="my-3">Account Information</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Contact Information
                                            <a href="{{ url('dashboard/profile') }}" class="card-edit">Edit</a>
                                        </div>

                                        <div class="card-body">
                                            <p>
                                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}<br>
                                                {{ auth()->user()->email }}<br>
                                                <a href="{{ url('dashboard/change-password') }}">@if (auth()->user()->password) Change @else Set @endif Password</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            newsletters
                                            <a href="#" class="card-edit">Edit</a>
                                        </div>

                                        <div class="card-body">
                                            <p>
                                                You are currently not subscribed to any newsletter.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (auth()->user()->socialiteProvider)
                                <div class="card">
                                    <div class="card-header">
                                        Social Authentication
                                    </div>

                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Provider</th>
                                                    <th width="110px">Profile</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (auth()->user()->socialiteProvider as $provider)
                                                    <tr>
                                                        <td width="110px" class="text-capitalize text-center">
                                                            @if ($provider->provider == "google")
                                                                <img width="60px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/1200px-Google_%22G%22_Logo.svg.png">
                                                            @else
                                                                <img width="80px" src="https://cdn4.iconfinder.com/data/icons/social-icon-4/842/facebook-512.png">
                                                            @endif
                                                            <div class="mt-2">{{ $provider->provider }}</div>
                                                        </td>
                                                        <td width="110px"><img width="100px" src="{{ $provider->provider_picture }}"></td>
                                                        <td>{{ auth()->user()->first_name }}</td>
                                                        <td>{{ auth()->user()->last_name }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- defind script page level --}}
@section('page-script')
@endsection

