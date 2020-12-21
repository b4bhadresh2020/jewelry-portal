@extends('layouts.contentLayoutMaster')

@section('title','Email Templates')

@section('vendor-style')
@endsection

{{-- page style --}}
@section('page-style')
@livewireStyles
@endsection

@section('content')
<div class="section">
    @livewire('admin.email')
    <div id="modal1" class="modal" style="width: 45%; !imporatant;">
        <div class="modal-content">
            <h5 class="mb-3">Email Template Content</h5>
            <div class="row" id="email_details">
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
@endsection

@section('page-script')
@livewireScripts
<script>
// livewire
window.addEventListener('jsTrigger', event => {
    // load custom js file
    $.getScript("{{ __url('js/custom/my-script.js') }}");
});
</script>
<script>
function showdModal(id) {
    //    console.log('hi',id);
    $.ajax({
        url: "{{ __url('admin/email-templates-details')}}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "id": id
        },
        success: function(data) {
            $('#email_details').html(data);
        }
    });
}
</script>
@endsection
