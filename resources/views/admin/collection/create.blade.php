{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Collection')
{{-- page content --}}
@section('vendor-style')
@endsection
@section('content')
<div class="row">
    <div class="col s12">
        <div id="input-fields" class="card card-tabs">
            <div class="card-content">
                <div class="card-title">
                    <div class="row">
                        <div class="col s6">
                            <h4 class="card-title">Add Collection</h4>
                        </div>
                        <div class="col s6 right-align">
                            @permission('view-collection')
                                <a href="{{ url('admin/collection') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow" >
                                    <i class="material-icons left">menu</i> View  Collection
                                </a>
                            @endpermission
                        </div>
                    </div>
                </div>
                <form class="row" method="post" action="{{url('admin/collection')}}">
                    @csrf
                    <div class="col s12 input-field">
                        <label for="Name"> Name</label>
                        <input id="Name" name="name" value="{{old('name')}}" type="text" class="validate" require>
                        <small class="errorTxt1">
                            @error('name')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                    <div class="input-field col s12">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('vendor-script')
@endsection

@section('page-script')

@endsection
