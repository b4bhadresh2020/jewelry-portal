@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title', 'Register')

    {{-- defind style page level --}}
@section('page-style')
@endsection

{{-- defind content --}}
@section('content')
    <div class="login_register-wrapper" id="register">
        <div class="container">
            <div class="login_register-inner">
                <h3>Register Account</h3>
                <h6>Already have an Icebox account? <a href="{{ url('signin') }}">Login</a></h6>
                <form method="POST">
                    @csrf
                    <div class="login_register-form">
                        <div class="form-group">
                            <div class="form-inner">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                <input value="{{ old('first_name') }}" name="first_name" type="text" class="form-control"
                                    placeholder="First Name">
                            </div>
                            @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-inner">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                <input value="{{ old('last_name') }}" name="last_name" type="text" class="form-control"
                                    placeholder="Last Name">
                            </div>
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-inner">
                                <div class="form-inner-call">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <select name="phone_code" class="custom-select" style="max-width: 90px;">
                                        <option value="+971" selected>+971</option>
                                        <option value="+91">+91</option>
                                        <option value="+58">+58</option>
                                        <option value="+701">+701</option>
                                        <option value="+972">+972</option>
                                        <option value="+972">+972</option>
                                    </select>
                                    <input value="{{ old('phone') }}" name="phone" class="form-control"
                                        placeholder="Phone Number" type="text">
                                </div>
                            </div>
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-inner">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <input value="{{ old('email') }}" name="email" type="email" class="form-control"
                                    placeholder="Email">
                            </div>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-inner">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <input value="{{ old('password') }}" name="password" type="password" class="form-control"
                                    placeholder="Password">
                            </div>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox"><span>Remember me</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </div>
                    <div class="login_register-or">
                        <div class="or"><span>OR</span></div>
                        <div class="login_register-google login-button"><a href="{{ url('auth/google') }}"><img
                                    src="{{ asset('assets') }}/img/google.svg"><span>Sign up to Google</span></a></div>
                        <div class="login_register-facebook login-button"><a href="{{ url('auth/facebook') }}"><img
                                    src="{{ asset('assets') }}/img/Facebbok.svg"><span>Sign up to Facebook</span></a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- defind script page level --}}
@section('page-script')
@endsection
