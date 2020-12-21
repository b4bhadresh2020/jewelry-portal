@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Testimonial')

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
                    <h4 class="card-title">Create Testimonial</h4>
                </div>
                <div class="col s6 right-align">
                    @permission('view-testimonial')
                        <a href="{{ url('admin/testimonial') }}"
                            class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow">
                            <i class="material-icons left">menu</i> View Testimonials
                        </a>
                    @endpermission
                </div>
            </div>
            <form method="POST" action="{{url('admin/testimonial')}}" enctype="multipart/form-data">
                @csrf
                <div class="row mt-4">
                    <div class="col s12">
                        <ul class="tabs">
                            @foreach ($findActiveLanguage as $item)
                                <li class="tab col m2"><a href="#tab{{$item->id}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    @foreach ($findActiveLanguage as $item)
                        <div id="tab{{$item->id}}" class="col s12">
                            <div class="input-field col m6 s12">
                                <input id="name{{$item->id}}" type="text" value="{{ old('name:'.$item->code) }}"
                                    name="name:{{$item->code}}">
                                <label for="name{{$item->id}}">Name ({{$item->name}})</label>
                                <small class="errorTxt2">
                                    @error('name:'.$item->code)
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                            <div class="input-field col m6 s12">
                                <input id="role{{$item->id}}" type="text" value="{{ old('role:'.$item->code) }}"
                                    name="role:{{$item->code}}">
                                <label for="role{{$item->id}}">Role ({{$item->name}})</label>
                                <small class="errorTxt2">
                                    @error('role:'.$item->code)
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                            <div class="input-field col m12 s12">
                                <label for="description{{$item->id}}" style="position:unset;">Description ({{$item->name}})</label>
                                <textarea  class="summernote mt-3" name="description:{{$item->code}}">{{ old('description:'.$item->code) }}</textarea>
                                <small class="errorTxt2">
                                    @error('description:'.$item->code)
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col m12 s12 file-field input-field">
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
