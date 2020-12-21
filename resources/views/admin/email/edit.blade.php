{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Email-Templates')

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
                            <h4 class="card-title">Edit Email Template</h4>
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
                    <form class="row" method="post" action="{{url('admin/email/'.$emailTemplate->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col s6 input-field">
                                <label for="Name"> Name</label>
                                <input id="Name" name="name" value="@if($errors->any()) {{ old('name')}} @else {{ $emailTemplate->name}} @endif" type="text" class="validate" require>
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
                                <input id="subject_demo" name="subject"  onclick="insertAtCaret1('subject')" value="@if($errors->any()) {{ old('subject')}} @else {{ $emailTemplate->subject}} @endif" type="text" class="validate" require>
                                <small class="errorTxt1">
                                    @error('subject')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8">
                                <textarea id="summernote" name="content">@if($errors->any()) {!! old('content')!!} @else {!!$emailTemplate->content!!} @endif</textarea>
                                <small class="errorTxt1">
                                    @error('content')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                            <div class="col s4">
                                <ul class="collection with-header">
                                    <li class="collection-header"><h4>Short Code List</h4></li>
                                    @foreach ($shortCode as $item)
                                        <li class="collection-item" style="cursor: pointer" title="Pick">
                                            <div onclick="insertAtCaret('summernote', '{{ $item['key'] }}');return false;">
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

    $('#summernote').summernote({

        tabsize: 4,
        height: 350,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['view', ['codeview', 'help']]
        ]
    });


    function insertAtCaret1(subject){
        var areaId=subject;
        $('#subjectHidden').val(areaId);
        return areaId;
    }


    function insertAtCaret(areaId, text) {
        if($('#subjectHidden').val()=='subject'){
            $('#subjectHidden').val('');
            var txt = $('#subject_demo').val()+' '+text;
            $('#subject_demo').val(txt);
        }else{
            $('#'+areaId).summernote('editor.restoreRange');
            $('#'+areaId).summernote('editor.focus');
            $('#'+areaId).summernote('editor.insertText', text);
        }
    }

</script>

@endsection
