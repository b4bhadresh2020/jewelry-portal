{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Sub Categories')

{{-- vendor styles --}}
@section('vendor-style')
@endsection

{{-- page style --}}
@section('page-style')
    @livewireStyles
@endsection


{{-- page content --}}
@section('content')
<div class="section">
    @livewire('admin.sub-category',[
        'categories'    => $categories
    ])
</div>
@endsection


{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{ asset('vendors/select2/select2.full.min.js') }}"></script>
@endsection

{{-- page script --}}
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
