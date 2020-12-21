{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Custom Sub Category')

{{-- vendor styles --}}
@section('vendor-style')
<link href="{{asset('vendors/summernote/summernote-lite.min.css')}}" rel="stylesheet">
@endsection

{{-- page content --}}

@section('content')
    <div class="section">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <div class="row">
                    <div class="col s6">
                        <h4 class="card-title">Edit Custom Sub Category</h4>
                    </div>
                    <div class="col s6 right-align">
                        @permission('view-custom-sub-category')
                            <a href="{{ url('admin/custom-sub-category') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow" >
                                <i class="material-icons left">menu</i> View Custom Sub Category
                            </a>
                        @endpermission
                    </div>
                </div>
                <form method="POST" action="{{ url('admin/custom-sub-category') }}/{{ $customSubCategory->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="input-field col m12 s12">
                            <select class="form-select" name="custom_category_id">
                                <option value="" disabled selected>Select Custom Category</option>
                                @foreach ($customCategories as $item)
                                    <option value="{{$item->id}}" {{(($item->id == $customSubCategory->custom_category_id)?'selected':'')}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                            <small class="errorTxt2">
                                @error('custom_category_id')
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    </div>


                    <div class="row mt-1">
                        <div class="col s12">
                            <ul class="tabs">
                                @foreach ($findActiveLanguage as $item)
                                <li class="tab col m2"><a href="#{{$item->name}}">{{$item->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        @foreach ($findActiveLanguage as $item)
                        <div id="{{$item->name}}" class="col s12 p-0">

                            <div class="input-field col m12 s12">
                                <label for="name{{$item->id}}" style="position:unset;">Content ({{$item->name}})</label>
                                <textarea  id="textarea2" class="summernote mt-3" name="content:{{$item->code}}"
                                    value="{{ old('name:'.$item->code) }}" >{{@$customSubCategory->translate(@$item->code)->content}}</textarea>
                                <small class="errorTxt2">
                                    @error('content:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light left ml-1" type="submit">Save
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/summernote/summernote-lite.min.js')}}"></script>
@endsection


{{-- page script --}}
@section('page-script')
<script type="text/javascript">
$('.summernote').summernote({
    tabsize: 4,
    height: 400,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link','picture']],
        ['view', ['codeview', 'help']]
    ]
});
</script>
@endsection
