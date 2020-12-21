<script>
    const BASEURL = window.location.origin;
</script>
<script src="{{asset('assets')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('assets')}}/js/bootstrap.bundle.js"></script>
<script src="{{asset('assets')}}/js/owl.carousel.min.js"></script>
<script src="{{asset('assets')}}/js/custom.js"></script>
<script src="{{asset('js/url_handle.js')}}"></script>
<script src="{{asset('plugin/toastr/toastr.min.js')}}"></script>
<script src="{{asset('plugin/jqueryconfirm/jquery-confirm.min.js')}}"></script>
<script src="{{asset('assets')}}/js/other.js"></script>
<script src="{{asset('assets')}}/js/lazy-load.js"></script>
<script>
    $(document).ready(function(){
        @if(session('toast_success'))
            toastr.success("{{session('toast_success')}}");
        @endif
        @if(session('toast_error'))
            toastr.error("{{session('toast_error')}}");
        @endif
        @if(session('warning_error'))
            toastr.warning("{{session('warning_error')}}");
        @endif

        // start savan
        if (typeof lazyload == 'function'){
            $("img.lazyload").lazyload();
        }
        // end savan
    });
</script>
@include('customer.js.common')


