{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Emnail Templates')
{{-- page content --}}
@section('vendor-style')

<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link href="{{asset('vendors/summernote/summernote-lite.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col s12">
        <div id="input-fields" class="card card-tabs">
            <div class="card-content">
                <div class="card-title">
                    <div class="row">
                        <div class="col s6">
                            <h4 class="card-title">Add Email Template</h4>
                        </div>
                        <div class="col s6 right-align">
                            @permission('view-email-template')
                                <a href="{{ url('admin/email') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow" >
                                    <i class="material-icons left">menu</i> View  Email Template
                                </a>
                            @endpermission
                        </div>
                    </div>
                </div>
                <div id="view-input-fields">
                    <form class="row" method="post" action="{{url('admin/email')}}">
                        @csrf
                        <div class="row">
                            <div class="col s6 input-field">
                                <label for="Name"> Name</label>
                                <input id="Name" name="name" value="{{old('name')}}" type="text" class="validate" require>
                                <small class="errorTxt1">
                                    @error('name')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 input-field">
                                <label for=""> Subject</label>
                                <input id="subject"  name="subject" value="{{old('subject')}}" type="text" class="validate" require>
                                <small class="errorTxt1">
                                    @error('subject')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s9">
                                <textarea id="summernote" name="content">{{old('content')}}</textarea>
                                <small class="errorTxt1">
                                    @error('content')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                            <div class="col s3">
                                <ul class="collection with-header">
                                    <li class="collection-header"><h4>Short Code List</h4></li>
                                    @foreach ($shortCode as $item)
                                        <li class="collection-item shortTag" style="cursor: pointer" title="Pick">
                                            <div data-key="{{ $item['key'] }}">
                                                {{ $item['value'] }}
                                            </div>
                                        </li>
                                    @endforeach
                                  </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" id="subjectHidden">
@endsection
@section('vendor-script')
<script src="{{asset('vendors/summernote/summernote-lite.min.js')}}"></script>
@endsection

@section('page-script')
<script type="text/javascript">
    var currentShortTagObj;
    var editor = $('#summernote').summernote({
        tabsize: 4,
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['view', ['codeview', 'help']]
        ]
    });

    $(document).on("click",".shortTag",function(){
        var shortTag = $(this).find("div").data("key");
        if(currentShortTagObj == "subject"){
            var subject = $('#'+currentShortTagObj).val()+' '+shortTag;
            $('#'+currentShortTagObj).val(subject);
        }else if(currentShortTagObj == "summernote") {
            $('#'+currentShortTagObj).summernote('editor.saveRange');
            $('#'+currentShortTagObj).summernote('editor.restoreRange');
            $('#'+currentShortTagObj).summernote('editor.insertText', shortTag);
        }
    });

    $(document).on("focus","#subject",function(){
        currentShortTagObj = $(this).attr("id");
    });

    editor.on("summernote.focus", function () {
        currentShortTagObj = $(this).attr("id");
        editor.summernote('editor.restoreRange');
    });

</script>
@endsection
