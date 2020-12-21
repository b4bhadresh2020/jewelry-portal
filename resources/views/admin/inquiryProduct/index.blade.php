@extends('layouts.contentLayoutMaster')

@section('title','Product Inquiry')

@section('page-style')
<style>

    .box{
        border: 1px solid #000;
        padding: 10px;
    }
    .size{
        font-size: 19px;
    }
</style>
@livewireStyles
@endsection
@section('content')
    @livewire('admin.product-inquiry')
@endsection

@section('page-script')
    @livewireScripts
    <script>
        // livewire
        window.addEventListener('jsTrigger', event => {
            $.getScript("{{ __url('js/custom/mcss-trigger.js') }}",function(){
                if(event.detail.viewMessageStatus){
                    var myInterval = setInterval(function(){
                        $("#modal1").modal('open');
                        clearInterval(myInterval);
                    },200);
                }
            });
        });
    </script>
  <script type="text/javascript">
    $('#replyInquiry').on('submit',function(event){
        event.preventDefault();
        var inquiryId = $('#inquiryId').val();
        var  reply = $('#reply').val();
        var status = $('.closeinquiry:checked').val();
        $.ajax({
            url: "{{__url('admin/inquiry-contact')}}/"+inquiryId,
            type:"PUT",
            data:{
                "_token": "{{ csrf_token() }}",
                reply:reply,
                status:status
            },
            success:function(response){
                var response = JSON.parse(response);
                if (response.status) {
                    $("#modal1").modal("close");
                    M.toast({
                        html: response.message,
                    });
                }
            },
        });
    });
</script>
@endsection

