@extends('customer.layouts.layoutMaster')

@section('title', 'OTP Verify')

@section('page-style')
@endsection

@section('content')
<div class="login_register-wrapper" id="forgot">
    <div class="container">
      <div class="login_register-inner">
         <h3>OTP Verifty</h3>
         <h6></h6>
         <form method="post" action="{{ url('otp-verify') }}">
            @csrf
           <div class="login_register-form">
             <div class="form-group">
               <div class="form-inner">
                 <i class="fa fa-key" aria-hidden="true"></i>
                 <input type="text"  name="otp" value="@if($errors->any()) {{ old('otp')}} @else {{ $code}} @endif" class="form-control" placeholder="Enter code">
                 @error('otp')
                 <div class="text-danger">{{ $message }}</div>
                 @enderror
               </div>
             </div>
             <button type="submit" class="btn btn-primary">OTP Verify</button>
            </div>
          </form>
       </div>
     </div>
  </div>
@endsection


{{-- defind script page level --}}
@section('page-script')
@endsection
