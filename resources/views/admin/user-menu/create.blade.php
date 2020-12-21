{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','User Menu')
{{-- page content --}}
@section('content')
<div class="section">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">

            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">Create User Menu</h4>
                </div>
                <div class="col s6 right-align">
                    @permission('view-user-menu')
                        <a href="{{ url('admin/user-menu') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow" >
                            <i class="material-icons left">menu</i> View User Menus
                        </a>
                    @endpermission
                </div>
            </div>

            <form method="POST" action="{{url('admin/user-menu')}}" enctype="multipart/form-data">
                @csrf

                @foreach ($findActiveLanguage as $item)
                    @if($loop->iteration % 2 == 0)
                        <div class="row">
                    @endif
                        <div class="input-field col m6 s12">
                            <input id="title{{$item->id}}" type="text" value="{{ old('title:'.$item->code) }}" name="title:{{$item->code}}">
                            <label for="title{{$item->id}}">Title Name ({{$item->name}})</label>
                            <small class="errorTxt2">
                                @error('title:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    @if($loop->iteration % 2 == 0)
                        </div>
                    @endif
                @endforeach

                <div class="row ml-0">
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
                    <div class="input-field col m6 s12">
                        <input id="link" type="text"  value="{{ old('link') }}" name="link">
                        <label for="link">Menu Link</label>
                        <small class="errorTxt2">
                            @error('link')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
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
