@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Catetgory')

{{-- defind style page level --}}
@section('page-style')
    @livewireStyles
@endsection

{{-- defind content --}}
@section('content')
    {{-- Start Category Banner --}}
    @include('customer.partials.category.banner')

    {{-- Start Inner Page --}}
    @include('customer.partials.category.inner-page')
@endsection