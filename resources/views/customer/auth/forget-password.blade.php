@extends('customer.layouts.layoutMaster')

@section('title', 'Forgot Password')

@section('page-style')
@endsection

@section('content')
<div class="login_register-wrapper" id="forgot">
    <div class="container">
      <div class="login_register-inner">
         <h3>Forgot password</h3>
         <h6>Please enter the email address you used to register. You will receive a temporary link to reset your password.</h6>

         @if (session('password_link'))
         <div class="alert alert-success alert-dismissible fade show">
             <button type="button" class="close" data-dismiss="alert">&times;</button>
             <strong>{{ session('password_link') }}</strong>
         </div>
         @endif

         <form method="post" action="{{ url('reset-password-link')}}">
            @csrf
           <div class="login_register-form">
             <div class="form-group">
               <div class="form-inner">
                 <i class="fa fa-envelope-o" aria-hidden="true"></i>
                 <input type="email"  name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email">
                 @error('email')
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

