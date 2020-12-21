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
                        <div class="frame card-header"><h3 class="title">  @auth @if (auth()->user()->password) Change @else Set @endif @endauth Password</h3></div>
                        <div class="frame card-body">
                            <form method="post">
                                @csrf

                                @auth
                                    @if (auth()->user()->password)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="profile-first-name">Old Password</label>
                                                    <input type="password" id="profile-first-name" name="oldpassword" class="form-control" placeholder="* * * * * * * *">
                                                    <div class="invalid-feedback"></div>
                                                    <small class="text-danger">
                                                        @if(session('success'))
                                                            <div class="text-success">{{session('success')}}</div>
                                                        @endif
                                                        @if(session('oldpassword'))
                                                            <div class="error">{{session('oldpassword')}}</div>
                                                        @endif
                                                        @error('oldpassword')
                                                            <div class="error">{{$message}}</div>
                                                        @enderror
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endauth
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="NewPassword">New Password</label>
                                            <input type="password" id="NewPassword" name="password" class="form-control" placeholder="* * * * * * * *">
                                            <div class="invalid-feedback"></div>
                                            <small class="text-danger">
                                                @error('password')
                                                    <div class="error">{{$message}}</div>
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ConfirmPassword">Confirm Password</label>
                                            <input type="password" id="ConfirmPassword" name="password_confirmation" class="form-control" placeholder="* * * * * * * *">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-radius-none btn-dark mt-3">Save</button>
                                        </div>
                                        <div class="my-4"></div>
                                    </div>
                                </div>
                            </form>
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

