{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Category')

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
                    <h4 class="card-title">Create Category</h4>
                </div>
                <div class="col s6 right-align">
                    @permission('view-category')
                        <a href="{{ url('admin/category') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow" >
                            <i class="material-icons left">menu</i> View  Category
                        </a>
                    @endpermission
                </div>
            </div>

            <form method="POST" action="{{url('admin/category')}}" enctype="multipart/form-data">
                @csrf

                {{-- @foreach ($findActiveLanguage as $item)
                    @if($loop->iteration % 2 == 0)
                        <div class="row">
                    @endif
                        <div class="input-field col m6 s12">
                            <input id="name{{$item->id}}" type="text" value="{{ old('name:'.$item->code) }}" name="name:{{$item->code}}">
                            <label for="name{{$item->id}}">Category Name ({{$item->name}})</label>
                            <small class="errorTxt2">
                                @error('name:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    @if($loop->iteration % 2 == 0)
                        </div>
                    @endif
                @endforeach --}}


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
                                <input id="name{{$item->id}}" type="text" value="{{ old('name:'.$item->code) }}"
                                    name="name:{{$item->code}}">
                                <label for="name{{$item->id}}">Name ({{$item->name}})</label>
                                <small class="errorTxt2">
                                    @error('name:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                            <div class="input-field col m12 s12">
                                <label for="name{{$item->id}}" style="position:unset;">Description ({{$item->name}})</label>
                                <textarea  id="textarea2" class="summernote mt-3" name="description:{{$item->code}}"
                                    value="{{ old('name:'.$item->code) }}" ></textarea>
                                <small class="errorTxt2">
                                    @error('description:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>File</span>
                            <input type="file" name="image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload category file">
                        </div>
                        <small class="errorTxt2">
                            @error('image')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>

                    <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>File</span>
                            <input type="file" name="banner_image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload banner file">
                        </div>
                        <small class="errorTxt2">
                            @error('banner_image')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>

                    <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>File</span>
                            <input type="file" name="offer_image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload offer file">
                        </div>
                        <small class="errorTxt2">
                            @error('offer_image')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>

                    <div class="col m2 s12 file-field input-field">
                        <label>
                            <input type="checkbox"  name="offer_banner_visibility" value="1" @if(old('offer_banner_visibility')) {{ "checked"}} @endif/>
                            <span>Offer File Visible</span>
                        </label>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn cyan waves-effect waves-light ml-1" type="submit">Submit
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
