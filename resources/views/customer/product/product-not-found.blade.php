@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Home')

{{-- defind style page level --}}
@section('page-style')
@endsection

{{-- defind content --}}
@section('content')
    <div class="container my-5 not-found">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-4 col-md-6 order-lg-first">
                <div class="text-center">
                    <div class="error_txt">{{ $code ?? 404 }}</div>
                    <h5 class="mb-2 mb-sm-3 subtitle">{{ $title ?? "Oops! The page you requested was not found!" }}</h5>
                    <p>{{ $subtitle ?? "The page you are looking for was moved, removed, renamed or might never existed." }}</p>
                    <div class="search_form pb-3 pb-md-4">
                        <form method="GET">
                            <input name="q" type="text" placeholder="Search" class="form-control">
                            <button type="submit" class="btn icon_search"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <a href="{{ url('/') }}" class="btn btn-dark">Back To Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- defind script page level --}}
@section('page-script')
@endsection

