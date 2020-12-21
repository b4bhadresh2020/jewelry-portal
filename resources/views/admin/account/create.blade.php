{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Create User')

{{-- vendor styles --}}
@section('vendor-style')
    <link href="{{asset('vendors/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendors/select2/select2-materialize.css') }}" rel="stylesheet" type="text/css">
@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">Create User</h4>
                </div>
                <div class="col s6 right-align">
                    <a href="{{ url('admin/account') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow" >
                        <i class="material-icons left">menu</i> View  Account
                    </a>
                </div>
            </div>
            <form action="{{ url('admin/account') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input name="first_name" id="first_name" type="text" value="{{ old('first_name') }}" class="validate" data-error=".errorTxt6">
                        <label for="first_name">First Name</label>
                        <small class="errorTxt2">
                            @error('first_name')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                    <div class="input-field col m6 s12">
                        <input name="last_name" id="last_name" type="text" value="{{ old('last_name') }}" class="validate" data-error=".errorTxt6">
                        <label for="last_name">Last Name</label>
                        <small class="errorTxt2">
                            @error('last_name')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col m6 s12">
                        <input name="email" id="email" type="email" value="{{ old('email') }}" class="validate" data-error=".errorTxt6">
                        <label for="email">Email</label>
                        <small class="errorTxt2">
                            @error('email')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>

                    <div class="input-field col m6 s12">
                        <input name="phone" id="phone" type="text" value="{{ old('phone') }}" class="validate" data-error=".errorTxt6">
                        <label for="phone">Phone</label>
                        <small class="errorTxt2">
                            @error('phone')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col m6 s12">
                        <input name="password" id="password" type="password" value="{{ old('password') }}" class="validate" data-error=".errorTxt6">
                        <label for="password">Password</label>
                        <small class="errorTxt2">
                            @error('password')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                    <div class="input-field col m6 s12">
                        <input name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}"  type="password" class="validate" data-error=".errorTxt6">
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s6">
                        <label for="">Group</label>
                        <select class="select2" name="group">
                            <option value="">Select Group</option>
                            @foreach ($groups as $group)
                                <option value="{{$group->slug}}" @if(old('group')==$group->slug) selected @endif>{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn cyan waves-effect waves-light" type="submit" name="action">Submit
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
    <script src="{{ asset('vendors/select2/select2.full.min.js') }}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script>
        $(document).ready(function(){
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        });
    </script>
@endsection
