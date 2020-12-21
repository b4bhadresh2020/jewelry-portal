{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Edit Customer')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">Edit Customer</h4>
                </div>
                <div class="col s6 right-align">
                    <a href="{{ url('admin/customer') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow" >
                        <i class="material-icons left">menu</i> View Customer
                    </a>
                </div>
            </div>
            <form action="{{ url('admin/customer') }}/{{ $user->id }}" method="post" enctype='multipart/form-data'>
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

