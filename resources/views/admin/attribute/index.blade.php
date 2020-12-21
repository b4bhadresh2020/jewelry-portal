{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Attributes')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<style>
    .table .ui-sortable-helper{background:#FFF; box-shadow:0px 0px 5px #000000; width:100%;}
    .order-change{
        width: 80px;
    }
</style>
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/data-tables.css')}}">
    <link rel="stylesheet" href="{{asset("vendors/jquery-ui/jquery-ui.css")}}" rel="nofollow" type="text/css">

    @livewireStyles
@endsection


{{-- page content --}}
@section('content')
<div class="section">
    @livewire('admin.attribute')
</div>
@endsection


{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
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

<script src="{{asset('js/scripts/data-tables.js')}}"></script>
<script src="{{asset('vendors/jquery-ui/jquery-ui.min.js')}}"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#sortable tbody').sortable({
    handle: 'i.fa-arrows-alt',
    placeholder: "ui-state-highlight",
    update : function () {
        var order       =   $('#sortable tbody').sortable('toArray', { attribute: 'data-sort-id'});
        sortOrder   =   order.join(',');
        $.post(
            '{{ __url("admin/reorder-attribute")}}',
            {'action':'updateSortedRows','sortOrder':sortOrder},
            function(data){
                var a   =   data.split('|***|');
                if(a[1]=="update"){
                    M.toast({
                            html: a[0],
                    });
                }
            }
        );
    }
});
$( "#sortable" ).disableSelection();
</script>
@endsection
