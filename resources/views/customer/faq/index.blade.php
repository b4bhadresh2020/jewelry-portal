@extends('customer.layouts.layoutMaster')

@section('title','Faq Inormation')

@section('page-style')
<style>

</style>
@endsection

@section('content')
    @include('customer.faq.banner')

    @if (count($faqCategories) == 0)
        <main id="main" class="site-main mb-5 pb-5" role="main">
            <section class="data-not-found not-found">
                <header class="page-header">
                    <h1 class="page-title">404</h1>
                </header>
                <div class="page-content">
                    <h5>We are sorry. you are looking page data can not found.</h5>
                    <a class="btn btn-info mt-2" href="{{ url('/') }}">Back To Home</a>
                </div>
            </section>
        </main>
    @else
        @include('customer.faq.faq')
    @endif

@endsection
