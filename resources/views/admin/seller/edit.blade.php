{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Seller')

{{-- page content --}}

@section('content')
<div class="section">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
            <h4 class="card-title">Edit Seller</h4>
            <form method="POST" action="{{ url('admin/seller') }}/{{ $seller->id }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                  <div class="row">
                    <div class="input-field col m6 s12">
                        <input name="title" id="title" type="text" value="{{ $seller->title }}" class="validate" data-error=".errorTxt6">
                        <label for="title">Title</label>
                        <small class="errorTxt2">
                            @error('title')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                    <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>File</span>
                            <input type="file" name="image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload seller file">
                        </div>
                        <small class="errorTxt2">
                            @error('image')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                </div>

                 <div class="row">
                    <div class="input-field col m6 s12">
                        <input name="subtitle" id="subtitle" type="text" value="{{ $seller->subtitle }}" class="validate" data-error=".errorTxt6">
                        <label for="subtitle">Sub Title</label>
                        <small class="errorTxt2">
                            @error('subtitle')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
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