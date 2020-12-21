{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Payment Gateway')
{{-- page content --}}
@section('vendor-style')
@endsection
@section('content')
<div class="row">
    <div class="col s12">
         <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                 <div class="row">
                    <div class="col s6">
                        <h4 class="card-title">Add Payment Gateway</h4>
                    </div>
                    <div class="col s6 right-align">
                        @permission('view-payment-gateway')
                            <a href="{{ url('admin/payment-gateway') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow" >
                                <i class="material-icons left">menu</i> Payment Gateway
                            </a>
                        @endpermission
                    </div>
                </div>

                <form  method="post" action="{{url('admin/payment-gateway')}}">
                        @csrf
                        <div class="row">
                            <div class="input-field col m7 s12">
                                <div class="col m3 p-0">
                                    <span>Payment Name</span>
                                </div>
                                <div class="col m2">
                                    <label>
                                        <input class="with-gap" name="name" type="radio" value="stripe"  {{ (old('name') == "stripe") ? "checked" : "" }}  />
                                        <span>Stripe</span>
                                    <label>
                                </div>
                                <div class="col m2">
                                    <label>
                                        <input class="with-gap" name="name" type="radio" value="paypal" {{ (old('name') == "paypal") ? "checked" : "" }} />
                                        <span>Paypal</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <small class="input-field errorTxt2">
                            @error('name')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </small>

                        <div class="row">
                            <div class="col s12 input-field">
                                <label for="Name"> Key</label>
                                <input id="Name" name="key" value="{{old('key')}}" type="text" class="validate" require>
                                <small class="errorTxt1">
                                    @error('key')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                            <div class="col s12 input-field">
                                <label for="Name"> Secret</label>
                                <input id="Name" name="secret" value="{{old('secret')}}" type="text" class="validate" require>
                                <small class="errorTxt1">
                                    @error('secret')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                            <div class="col s12 input-field">
                                <label for="Name"> Return Url</label>
                                <input id="Name" name="return_url" value="{{old('return_url')}}" type="text" class="validate" require>
                                <small class="errorTxt1">
                                    @error('return_url')
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                            <div class="input-field col s12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
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
