{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Custom Category')

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
    @livewire('admin.custom-category')
</div>
@endsection


{{-- vendor scripts --}}
@section('vendor-script')
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
