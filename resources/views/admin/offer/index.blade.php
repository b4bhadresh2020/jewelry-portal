{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Product Offer')

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
    @livewire('admin.offer')
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
            $.getScript("{{__url('js/custom/my-script.js') }}");
            // load custom js file
        });


    </script>
     <script>
         function changeStatus(id){
            $.ajax({
                url: "{{__url('admin/offer-status-update')}}",
                type: "POST",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function (result) {
                   if(result){
                     toastr.success("status update Succssfully..!");
                   }
                }
            });
        }
    </script>
@endsection
