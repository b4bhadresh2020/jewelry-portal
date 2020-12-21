@extends('layouts.contentLayoutMaster')
@section('title','All Subscriber')

@section('vendor-style')
@endsection

{{-- page style --}}
@section('page-style')
    @livewireStyles
@endsection

@section('content')
    @livewire('admin.sub-scriber')
@endsection

@section('vendor-script')
@endsection

@section('page-script')
@livewireScripts
<script>
    // livewire
    window.addEventListener('jsTrigger', event => {
        // load custom js file
        $.getScript("{{ __url('js/custom/mcss-trigger.js') }}");
    });
</script>
@endsection
