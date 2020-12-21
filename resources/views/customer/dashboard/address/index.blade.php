@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Dashboard')

{{-- defind style page level --}}
@section('page-style')
    <link href="{{asset('assets')}}/css/dashboard.css" rel="stylesheet" type="text/css"/>
@endsection

{{-- defind content --}}
@section('content')
    <section class="my-5 addresses-section">

        <div class="container">
            <div class="row">

                {{-- Dashboard Sidebar --}}
                @include('customer.layouts.dashboard-sidebar')

                <div class="col-lg-9 order-lg-last dashboard-content">
                    <div class="card frame">
                        <div class="frame card-header"><h3 class="title">Address Book</h3></div>
                        <div class="frame card-body">

                            @if (!$userHasDefaultAddress)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>You do not have any default address please create / set default address!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif

                            <div class="row addresses-list">
                                <div class="col-md-4">
                                    <a class="mb-4 addresses-list__item addresses-list__item--new" href="{{ url('dashboard/address/create') }}">
                                        <div class="addresses-list__plus"></div>
                                        <div class="btn btn-light btn-radius-none">Add New</div>
                                    </a>
                                </div>
                                @foreach (auth()->user()->address as $address)
                                    <div class="col-md-4">
                                        <div class="card mb-4 address-card addresses-list__item">
                                            <div class="card__loader"></div>
                                            @if ($address->is_default)
                                                <div class="address-card__badge tag-badge tag-badge--theme">Default</div>
                                            @endif
                                            <div class="address-card__body">
                                                <div class="address-card__name">{{ $address->first_name }} {{ $address->last_name }}</div>
                                                <div class="address-card__row">
                                                    {{ $address->address_line_one }}<br>
                                                    @if ($address->address_line_two != "")
                                                        {{ $address->address_line_two }}<br>
                                                    @endif
                                                    {{ $address->city->name }}, {{ $address->city->state->name }}<br>{{ $address->city->country->name }}, {{ $address->zipcode}} </div>
                                                <br>
                                                <div class="address-card__row">
                                                    <div class="address-card__row-title">Phone Number</div>
                                                    <div class="address-card__row-content">{{ $address->phone }}</div>
                                                </div>
                                                <br>
                                                <div class="address-card__row">
                                                    <div class="address-card__row-title">Email Address</div>
                                                    <div class="address-card__row-content">{{ $address->email }}</div>
                                                </div>
                                                <br>
                                                <div class="address-card__footer">
                                                    <a href="{{ url('dashboard/address') }}/{{ $address->id }}/edit">Edit Address</a>
                                                        &nbsp;&nbsp;
                                                    <a  href="javascript:void(0)"
                                                        data-csrf="{{ csrf_token() }}"
                                                        data-url="{{ url('dashboard/address/'.$address->id) }}"
                                                        data-title="Address Remove Confirmation!"
                                                        data-content="Are you sure you want to remove this address?"
                                                        class="common-remove-popup">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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

