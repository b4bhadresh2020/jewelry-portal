@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Blog')
@section('vendor-style')
<style>
    .note-modal-footer {
        height: 60px !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link href="{{asset('vendors/summernote/summernote-lite.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="section">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">Edit Blog</h4>
                </div>
                <div class="col s6 right-align">
                    @permission('view-blog')
                        <a href="{{ url('admin/blog') }}"
                            class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow">
                            <i class="material-icons left">menu</i> View Blog
                        </a>
                    @endpermission
                </div>
            </div>
            <form method="POST" action="{{ url('admin/blog') }}/{{ $blog->id }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row mt-4">
                    <div class="col s12">
                        <ul class="tabs">
                            @foreach ($findActiveLanguage as $item)
                            <li class="tab col m2"><a href="#{{$item->name}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @foreach ($findActiveLanguage as $item)
                    <div id="{{$item->name}}" class="col s12">

                        <div class="input-field col m12 s12">
                            <input id="name{{$item->id}}" type="text" value="{{@$blog->translate(@$item->code)->title}}" name="title:{{$item->code}}"
                                name="title:{{$item->code}}">
                            <label for="title{{$item->id}}">Title ({{$item->name}})</label>
                            <small class="errorTxt2">
                                @error('title:'.$item->code)
                                <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>

                        <div class="input-field col m12 s12">
                            <input id="name{{$item->id}}" type="text"
                                value="{{@$blog->translate(@$item->code)->short_description}}" name="short_description:{{$item->code}}">
                            <label for="name{{$item->id}}">Short Description ({{$item->name}})</label>
                            <small class="errorTxt2">
                                @error('short_description:'.$item->code)
                                <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                        <div class="input-field col m12 s12">
                            <label for="name{{$item->id}}" style="position:unset;">Long Description ({{$item->name}})</label>
                            <textarea id="textarea2" name="long_description:{{$item->code}}"
                                value="{{ old('name:'.$item->code) }}"
                                class=" summernote materialize-textarea">{{@$blog->translate(@$item->code)->long_description}}</textarea>
                            <small class="errorTxt2">
                                @error('long_description:'.$item->code)
                                <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col m6 s12 file-field input-field">
                            <div class="btn float-right">
                                <span>File</span>
                                <input type="file" name="image">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                            <small class="errorTxt2">
                                @error('image')
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 right-align">
                            <button class="btn cyan waves-effect waves-light ml-1" type="submit">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('vendor-script')
<script src="{{asset('vendors/summernote/summernote-lite.min.js')}}"></script>
@endsection
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
            // ['insert', ['link','picture']],
            ['view', ['codeview', 'help']]
        ]
    });
</script>
@endsection
