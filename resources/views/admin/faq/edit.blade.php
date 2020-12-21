@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Faq Information')
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
                    <h4 class="card-title">Edit Faq</h4>
                </div>
                <div class="col s6 right-align">
                    @permission('view-faq-information')
                        <a href="{{ url('admin/faq') }}"
                            class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow">
                            <i class="material-icons left">menu</i> View Faq Information
                        </a>
                    @endpermission
                </div>
            </div>
            <form method="POST" action="{{ url('admin/faq') }}/{{ $faq->id }}" enctype="multipart/form-data">
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
                            <select class="form-select" name="faq_category_id">
                                <option value="" disabled selected>Select FaqCategory</option>
                                @foreach ($faqCategory as $category)
                                <option value="{{$category->id}}"
                                    {{(($category->id == $faq->faq_category_id)?'selected':'')}}>{{$category->name}}
                                </option>
                                @endforeach
                            </select>

                            <small class="errorTxt2">
                                @error('faq_category_id')
                                <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                        <div class="input-field col m12 s12">
                            <input id="name{{$item->id}}" type="text"
                                value="{{@$faq->translate(@$item->code)->question}}" name="question:{{$item->code}}">
                            <label for="name{{$item->id}}">Quetions ({{$item->name}})</label>
                            <small class="errorTxt2">
                                @error('question:'.$item->code)
                                <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                        <div class="input-field col m12 s12">
                            <label for="name{{$item->id}}" style="position:unset;">Answer ({{$item->name}})</label>
                            <textarea id="textarea2" name="answer:{{$item->code}}"
                                value="{{ old('name:'.$item->code) }}"
                                class="summernote materialize-textarea">{{@$faq->translate(@$item->code)->answer}}</textarea>
                            <small class="errorTxt2">
                                @error('answer:'.$item->code)
                                <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    </div>
                    @endforeach
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
