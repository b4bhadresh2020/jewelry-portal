{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Edit User')

{{-- vendor styles --}}
@section('vendor-style')
    <link href="{{asset('vendors/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendors/select2/select2-materialize.css') }}" rel="stylesheet" type="text/css">
@endsection

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">Edit User</h4>
                </div>
                <div class="col s6 right-align">
                    <a href="{{ url('admin/account') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow" >
                        <i class="material-icons left">menu</i> View  Account
                    </a>
                </div>
            </div>
            <form action="{{ url('admin/account') }}/{{ $user->id }}" method="post" enctype='multipart/form-data'>
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="input-field col m6 s12">
                        <input name="first_name" id="first_name" type="text" value="@if($errors->any()) {{ old('first_name')}} @else {{ $user->first_name}} @endif" class="validate" data-error=".errorTxt6">
                        <label for="first_name">First Name</label>
                        <small class="errorTxt2">
                            @error('first_name')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                    <div class="input-field col m6 s12">
                        <input name="last_name" id="last_name" type="text" value="@if($errors->any()) {{ old('last_name')}} @else {{ $user->last_name}} @endif" class="validate" data-error=".errorTxt6">
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
                        <input name="email" id="email" type="email" value="@if($errors->any()) {{ old('email')}} @else {{ $user->email}} @endif" class="validate" data-error=".errorTxt6">
                        <label for="email">Email</label>
                        <small class="errorTxt2">
                            @error('email')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>

                    <div class="input-field col m6 s12">
                        <input name="phone" id="phone" type="text" value="@if($errors->any()) {{ old('phone')}} @else {{ $user->phone}} @endif" class="validate" data-error=".errorTxt6">
                        <label for="phone">Phone</label>
                        <small class="errorTxt2">
                            @error('phone')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                </div>

                <div class="row">
                    <div class="col s6">
                        <label for="">Group</label>
                        <select class="select2" name="group">
                            <option value="">Select Group</option>
                            @foreach ($groups as $group)
                                <option value="{{$group->slug}}" {{ ($group->id == $groupId)?'selected':'' }}>{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn cyan waves-effect waves-light " type="submit" name="action">Save
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
