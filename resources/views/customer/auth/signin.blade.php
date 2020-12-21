@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title', 'Login')

    {{-- defind style page level --}}
@section('page-style')
@endsection

{{-- defind content --}}
@section('content')
    <div class="login_register-wrapper" id="login">
        <div class="container">
            <div class="login_register-inner">
                <h3>Login Account</h3>
                <h6>Don’t have an account? <a href="{{ url('signup') }}">Sign up</a></h6>

                @if (session('reset_success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>{{ session('reset_success') }}</strong>
                </div>
                @endif

                @if (session('signup_success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ session('signup_success') }}</strong>
                    </div>
                @endif

                @if (session('signin_error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ session('signin_error') }}</strong>
                    </div>
                @endif

                <form method="post">
                    @csrf
                    <div class="login_register-form">
                        <div class="form-group">
                            <div class="form-inner">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <input value="{{ old('email') }}" name="email" type="email" class="form-control"
                                    placeholder="Enter email">
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
                        <button type="submit" class="btn btn-primary">Login</button>
                        <div class="login_register-Forgot">
                            <p>Forgot your password ? <a href="{{url('reset-password')}}">Reset Password</a></p>
                        </div>
                    </div>
                    <div class="login_register-or">
                        <div class="or"><span>OR</span></div>
                        <div class="login_register-google login-button"><a href="{{ url('auth/google') }}"><img
                                    src="{{ asset('assets') }}/img/google.svg"><span>Sign in to Google</span></a></div>
                        <div class="login_register-facebook login-button"><a href="{{ url('auth/facebook') }}"><img
                                    src="{{ asset('assets') }}/img/Facebbok.svg"><span>Sign in to Facebook</span></a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- defind script page level --}}
@section('page-script')
@endsection
