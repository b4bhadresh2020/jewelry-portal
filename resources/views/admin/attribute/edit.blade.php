{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Edit Attribute')
{{-- page content --}}

@section('content')
<div class="section">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">Edit Attribute</h4>
                </div>
                <div class="col s6 right-align">
                    @permission('view-attribute')
                        <a href="{{ url('admin/attribute') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow" >
                            <i class="material-icons left">menu</i> View All Attribute
                        </a>
                    @endpermission
                </div>
            </div>
            <form method="POST" action="{{ url('admin/attribute') }}/{{ $attribute->id }}" enctype="multipart/form-data">
                @csrf
                @method('put')


                @foreach ($findActiveLanguage as $item)
                    @if($loop->iteration % 2 == 0)
                        <div class="row">
                    @endif
                        <div class="input-field col m6 s12">
                            <input id="name{{@$item->id}}"  type="text" value="{{@$attribute->translate(@$item->code)->name}}" name="name:{{@$item->code}}" />
                            <label for="name{{@$item->id}}">Attribute Name ({{@$item->name}})</label>
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

                @developer
                    <div class="row">
                        <div class="col m6 s12 file-field input-field">
                            <div class="btn float-right">
                                <span>File</span>
                                <input type="file" name="image">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload Attribute file">
                            </div>
                        </div>
                    </div>
                    <div>
                        <img src="{{ @getMediaUrlToMedia($attribute->media) }}">
                    </div>
                    <div class="input-field col m6 s12">
                        <input id="key" type="text" value="{{ $attribute->key }}" name="key" />
                        <label for="key">Attribute Key</label>
                        <small class="errorTxt2">
                            @error('key')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                @enddeveloper

                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn cyan waves-effect waves-light left" type="submit">Save
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
