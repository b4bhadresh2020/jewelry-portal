{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Faq Category')
{{-- page content --}}

@section('content')
<div class="section">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">Edit FaqCategory</h4>
                </div>
                <div class="col s6 right-align">
                    @permission('view-faq-category')
                        <a href="{{ url('admin/faq-category') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow" >
                            <i class="material-icons left">menu</i> View  Category
                        </a>
                    @endpermission
                </div>
            </div>
            <form method="POST" action="{{ url('admin/faq-category') }}/{{ $faqcategory->id }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    @foreach ($findActiveLanguage as $item)
                        @if($loop->iteration % 2 == 0)
                            <div class="row">
                        @endif
                            <div class="input-field col m6 s12">
                                <input id="name{{@$item->id}}"  type="text" value="{{@$faqcategory->translate(@$item->code)->name}}" name="name:{{@$item->code}}">
                                <label for="name{{@$item->id}}">Category Name ({{@$item->name}})</label>
                                <small class="errorTxt2">
                                    @error('name:'.@$item->code)
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                        @if($loop->iteration % 2 == 0)
                            </div>
                        @endif
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
