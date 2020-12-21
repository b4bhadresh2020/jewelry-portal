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
                        <div class="frame card-header"><h3 class="title">Profile</h3></div>
                        <div class="frame card-body">
                            <form method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <center>
                                        <label for="pro_img" class="hand">
                                            <img style="width: 70px;height: 70px;" src="{{ userProfile(auth()->user()) }}" class="img-responsive imagePreviewPath img-circle">
                                        </label>
                                        <div class="display-image-name"> User Profile</div>
                                        <div class="text-warning"> [Only allow .jpeg, .jpg, .png, .svg file]</div>
                                        @error('profile')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </center>
                                    <input type="file" name="profile" onchange="img_pathUrl(this,'.imagePreviewPath');" class="imageUploadPath1" id="pro_img" style="display: none;">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile-first-name">First Name</label>
                                            <input type="text" id="profile-first-name" name="first_name" class="form-control" value="@if($errors->any()) {{ old('first_name')}} @else {{ auth()->user()->first_name}} @endif">
                                            <div class="invalid-feedback"></div>
                                            @error('first_name')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile-last-name">Last Name</label><input type="text" id="profile-last-name" name="last_name" class="form-control" value="@if($errors->any()) {{ old('last_name')}} @else {{ auth()->user()->last_name}} @endif">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile-email">Email address</label><input type="email" id="profile-email" name="email" class="form-control" value="@if($errors->any()) {{ old('email')}} @else {{ auth()->user()->email}} @endif">
                                            <div class="invalid-feedback"></div>
                                            @error('email')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile-phone">Phone Number</label><input type="text" id="profile-phone" name="phone" class="form-control" value="@if($errors->any()) {{ old('phone')}} @else {{ auth()->user()->phone }} @endif">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address-country">Country</label>
                                            <select data-ajax='true' id="address-country" class="form-control">
                                                @if(!auth()->user()->city_id)
                                                    <option value="">Select a country...</option>
                                                @endif
                                                @foreach ($countries as $country)
                                                    <option @if(auth()->user()->city_id && @auth()->user()->city->country->id ==  $country->id) selected  @endif value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address-state">State</label>
                                            <select data-ajax="true" id="address-state" class="form-control">
                                                @if(!auth()->user()->city_id)
                                                    <option value="">Select a state...</option>
                                                @else
                                                    <option value="{{ auth()->user()->city->state->id }}">{{ auth()->user()->city->state->name }}</option>
                                                @endif
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address-city">City</label>
                                            <select id="address-city" name="city_id" class="form-control">
                                                @if(!auth()->user()->city_id)
                                                    <option value="">Select a city...</option>
                                                @else
                                                    <option value="{{ auth()->user()->city->id }}">{{ auth()->user()->city->name }}</option>
                                                @endif
                                            </select>
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
    @include('customer.js.common')
@endsection

