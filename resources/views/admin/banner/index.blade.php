@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Banner')


@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<style>
    .table .ui-sortable-helper{background:#FFF; box-shadow:0px 0px 5px #000000; width:100%;}
</style>
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/data-tables.css')}}">
    <link rel="stylesheet" href="{{asset("vendors/jquery-ui/jquery-ui.css")}}" rel="nofollow" type="text/css">

@endsection


{{-- page content --}}
@section('content')
<div class="section section-data-tables">
    <div class="row">
        <div class="col s12 m12 l12">
            <div id="button-trigger" class="card card card-default scrollspy">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12 right-align mb-2 ">
                            @permission('add-banner')
                                <a href="{{ url('admin/banner/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                                    <i class="material-icons left">add</i> Add New
                                </a>
                            @endpermission
                        </div>
                        @if(count($banners) != 0)
                            <div class="col s12">
                                <form id="form" method="post">
                                    @csrf
                                    <input type="hidden" name="action" value="saveAddMore">
                                    <table id="sortable" class="display sortable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Banner</th>
                                                <th>Mobile Banner</th>
                                                <th>Header</th>
                                                <th>Title</th>
                                                <th>Link Text</th>
                                                <th>Link Url</th>
                                                <th>Description</th>
                                                @anypermission('edit-banner','delete-banner')
                                                    <th>Action</th>
                                                @endanypermission
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($banners as $banner)
                                                <tr data-sort-id="{{$banner->id}}">
                                                    <td align="center"><i class="fa fa-fw fa-arrows-alt" data-toggle="tooltip" title="Grag up or down"></i></td>
                                                    @if($banner->banner!=null)
                                                        <td width="150px"><img class="img-zoom-2" src="{{ url('storage/'.$banner->banner) }}" height="100px" width="80px"></td>
                                                    @else
                                                        <td width="150px"><img class="img-zoom-2" src="{{url('default/not-found.png')}}" height="100px" width="80px"></td>
                                                    @endif
                                                    @if($banner->mobile_banner!=null)
                                                        <td width="150px"><img class="img-zoom-2" src="{{ url('storage/'.$banner->mobile_banner) }}" height="100px" width="80px"></td>
                                                    @else
                                                        <td width="150px"><img class="img-zoom-2" src="{{url('default/not-found.png')}}" height="100px" width="80px"></td>
                                                    @endif
                                                    <td>{{ $banner->header }}</td>
                                                    <td>{{ $banner->title }}</td>
                                                    <td>{{ $banner->link_text }}</td>
                                                    <td>{{ $banner->link_url }}</td>
                                                    <td>{{ $banner->description }}</td>
                                                    @anypermission('edit-banner','delete-banner')
                                                        <td width="100px">
                                                            <a class='dropdown-trigger' data-target='dropdown{{ $banner->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                            <ul id='dropdown{{ $banner->id }}' class='dropdown-content'>
                                                                @permission('edit-banner')
                                                                    <li><a href="{{ url('admin/banner') }}/{{ $banner->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
                                                                @endpermission
                                                                @permission('delete-banner')
                                                                    <li>
                                                                        <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/banner/'.$banner->id) }}" data-title="Delete Account Confirmation!" data-content="Are you sure you want to delete this Banner?" class="common-remove-popup">
                                                                            <i class="material-icons">delete</i> Delete
                                                                        </a>
                                                                    </li>
                                                                @endpermission
                                                            </ul>
                                                        </td>
                                                    @endanypermission
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        @else
                            <div class="col s12">
                                <div class="dnf-ui-card">
                                    <div class="center-align">
                                        <img width="40%" src="{{ url('assets/img/dnf-ui.jpg') }}">
                                        <h4 class="dnf-ui-title">Sorry, Banners List Not Found..</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
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
            '{{ __url("admin/reorder-banner")}}',
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
