{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Payment Gateway')

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
    @livewire('admin.payment-gateway')
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
            $.getScript("{{url('js/custom/mcss-trigger.js') }}");
        });
    </script>
     <script>
         function changeStatus(id){
            $.ajax({
                url: "{{__url('admin/payment-gateway-status-update')}}",
                type: "POST",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function (result) {
                   if(result){
                     toastr.success("status update Succssfully..!");
                     location.reload();
                   }
                }
            });
        }
    </script>
@endsection
