@php
    use App\Address;
@endphp
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
                        <div class="frame card-header"><h3 class="title">Add New Address</h3></div>
                        <div class="frame card-body">
                            <form method="post" action="{{ url('dashboard/address') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile-first-name">First Name</label>
                                            <input type="text" id="profile-first-name" name="first_name" class="form-control" value="{{ old('first_name') }}">
                                            <div class="invalid-feedback"></div>
                                            @error('first_name')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile-last-name">Last Name</label>
                                            <input type="text" id="profile-last-name" name="last_name" class="form-control" value="{{ old('last_name') }}">
                                            <div class="invalid-feedback"></div>
                                            @error('last_name')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                <div class="row">
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address-company-name">Company Name<span class="text-muted"> (Optional)</span></label>
                                            <input type="text" id="address-company-name" name="company_name" class="form-control" value="{{ old('company_name') }}">
                                            @error('company_name')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile-email">Email address</label>
                                            <input type="email" id="profile-email" name="email" class="form-control" value="{{ old('email') }}">
                                            <div class="invalid-feedback"></div>
                                            @error('email')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile-phone">Phone Number</label>
                                            <input type="text" id="profile-phone" name="phone" class="form-control" value="{{ old('phone') }}">
                                            <div class="invalid-feedback"></div>
                                            @error('phone')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="profile-phone">Save As</label>
                                        <div class="form-group">
                                            <label for="radioHome" class="radio-inline">
                                                <input @if(old('address_as') == Address::ADDRESS_AS_HOME) checked @endif value="{{ Address::ADDRESS_AS_HOME }}" id="radioHome" type="radio" name="address_as" checked> Home
                                            </label>
                                            <label for="radioOffice" class="radio-inline">
                                                <input @if(old('address_as') == Address::ADDRESS_AS_OFFICE ) checked @endif value="{{ Address::ADDRESS_AS_OFFICE }}" id="radioOffice" type="radio" name="address_as"> Office
                                            </label>
                                            <label for="radioOther" class="radio-inline">
                                                <input @if(old('address_as') == Address::ADDRESS_AS_OTHER) checked @endif value="{{ Address::ADDRESS_AS_OTHER }}" id="radioOther" type="radio" name="address_as"> Other
                                            </label>
                                        </div>
                                        @error('address_as')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label for="profile-phone">Address Type</label>
                                        <div class="form-group">
                                            <label for="radioBilling" class="radio-inline">
                                                <input @if(old('type') == Address::TYPE_BILLING) checked @endif value="{{ Address::TYPE_BILLING }}" id="radioBilling" type="radio" name="type" checked> Billing
                                            </label>
                                            <label for="radioShipping" class="radio-inline">
                                                <input @if(old('type') == Address::TYPE_SHIPPING) checked @endif value="{{ Address::TYPE_SHIPPING }}" id="radioShipping" type="radio" name="type"> Shipping
                                            </label>
                                        </div>
                                        @error('type')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div> --}}
                                     <div class="col-md-6">
                                        <label for="profile-phone">Save As Default</label>
                                        <div class="form-group">
                                            <label for="isDefaultCheckBox" class="radio-inline">
                                                <input @if(old('is_default') == 1) checked @endif value="1" id="isDefaultCheckBox" type="checkbox" name="is_default" checked> Yes / No
                                            </label>
                                        </div>
                                        @error('address_as')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address-address1">Street Address</label>
                                            <input type="text" id="address-address1" name="address_line_one" class="form-control" value="{{ old('address_line_one') }}">
                                            @error('address_line_one')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                            <div class="invalid-feedback"></div>
                                            <label for="address-address2" class="sr-only">Street Address</label>
                                            <input type="text" id="address-address2" name="address_line_two" class="form-control mt-2" value="{{ old('address_line_two') }}">
                                            @error('address_line_two')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address-country">Country</label>
                                            <select data-ajax='true' id="address-country" name="country_id" class="form-control">
                                                <option value="">Select a country...</option>
                                                @foreach ($countries as $country)
                                                    <option @if($country->id == old('country_id')) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                            @error('country_id')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address-state">State</label>
                                            <select data-ajax='true' id="address-state" class="form-control">
                                                <option value="">Select a state...</option>
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
                                                <option value="">Select a city...</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                            @error('city_id')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="zipcode">Zipcode</label>
                                            <input type="text" id="zipcode" name="zipcode" class="form-control" value="{{ old('zipcode') }}">
                                            <div class="invalid-feedback"></div>
                                            @error('zipcode')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
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

