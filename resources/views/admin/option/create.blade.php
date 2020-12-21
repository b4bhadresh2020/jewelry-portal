{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Add New Option')
{{-- page content --}}
@section('content')
<div class="section">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">

            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">Create Option</h4>
                </div>
                <div class="col s6 right-align">
                    @permission('view-option')
                        <a href="{{ url('admin/option') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow" >
                            <i class="material-icons left">menu</i> View  Options
                        </a>
                    @endpermission
                </div>
            </div>

            <form method="POST" action="{{url('admin/option')}}" enctype="multipart/form-data">
                @csrf

                @foreach ($findActiveLanguage as $item)
                    @if($loop->iteration % 2 == 0)
                        <div class="row">
                    @endif
                        <div class="input-field col m6 s12">
                            <input id="name{{$item->id}}" type="text" value="{{ old('name:'.$item->code) }}" name="name:{{$item->code}}" />
                            <label for="name{{$item->id}}">Option Name ({{$item->name}})</label>
                            <small class="errorTxt2">
                                @error('name:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    @if($loop->iteration % 2 == 0)
                        </div>
                    @endif
                @endforeach

                <div class="row">
                    <div class="input-field col m6 s12">
                        <select class="form-select" name="attribute_id">
                            <option value="" disabled selected>Select Attribute</option>
                            @foreach ($attributes as $attribute)
                                <option @if(old('attribute_id')==$attribute->id) selected @endif value="{{$attribute->id}}">{{$attribute->name}}</option>
                            @endforeach
                        </select>
                        <small class="errorTxt2">
                            @error('attribute_id')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                </div>

                @developer
                    <div class="row">
                        <div class="col m6 s12 file-field input-field">
                            <div class="btn float-right">
                                <span>File</span>
                                <input type="file" name="image">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload Option file">
                            </div>
                        </div>
                    </div>
                @enddeveloper

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
