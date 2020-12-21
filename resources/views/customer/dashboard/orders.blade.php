@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Dashboard')

{{-- defind style page level --}}
@section('page-style')
    <link href="{{asset('assets')}}/css/dashboard.css" rel="stylesheet" type="text/css"/>
@endsection

{{-- defind content --}}
@section('content')
    <section class="my-5 order-section">

        <div class="container">
            <div class="row">

                {{-- Dashboard Sidebar --}}
                @include('customer.layouts.dashboard-sidebar')

                <div class="col-lg-9 order-lg-last dashboard-content">
                    <div class="card frame">
                        <div class="frame card-header"><h3 class="title">My Orders</div>
                        <div class="frame card-body">

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

