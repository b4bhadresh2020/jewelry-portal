@extends('customer.layouts.layoutMaster')

@section('title', 'Forgot Password')

@section('page-style')
@endsection

@section('content')
<div class="login_register-wrapper" id="forgot">
    <div class="container">
      <div class="login_register-inner">
         <h3>Reset password</h3>
         <h6></h6>
         <form method="post" action="{{ route('password.update') }}">
            @csrf
           <div class="login_register-form">
             <div class="form-group">
               <div class="form-inner">
                 <i class="fa fa-envelope-o" aria-hidden="true"></i>
                 <input type="text"  name="email"  value="@if($errors->any()){{ old('email')}}@else{{Session::get('email')}}@endif" class="form-control" placeholder="Enter email">
                 @error('email')
                 <div class="text-danger">{{ $message }}</div>
                 @enderror
               </div>
             </div>
             <div class="form-group">

               <div class="form-inner">
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <input value="" name="password" type="password" class="form-control" placeholder="Password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

             <div class="form-group">
                <div class="form-inner">
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <input value="" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

             </div>
             <button type="submit" class="btn btn-primary">Send reset link</button>
           </div>
         </form>
      </div>
    </div>
 </div>

@endsection

{{-- defind script page level --}}
@section('page-script')
@endsection

