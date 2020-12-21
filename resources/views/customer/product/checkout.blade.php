@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Checkout')

{{-- defind style page level --}}
@section('page-style')
@endsection

{{-- defind content --}}
@section('content')
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="breadcrumb-title">Checkout</div>
            <div class="breadcrumb-ul">
                <ul>
                    <li class="breadcrumb-nav"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-nav active"><a href="javascript:;">Checkout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="checkout-wrapper">
        <div class="container">
            <div class="checkout-block">
                <div class="checkout-inner">
                    <div class="accordion" id="accordionExample">

                        {{-- User signup create --}}
                        <div class="card login-signup-block" id="login-signup-block">
                            <div class="card-header signin-block">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Contact information
                                </button>
                                <div class="card-sign-in-block">
                                    <a href="{{url('signin')}}">
                                        <span>Sign in</span>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                            <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form method="post" id="signup-form">
                                        @csrf
                                        <div class="login_register-form">
                                            <div class="form-group">
                                                <div class="form-inner">
                                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                                    <input value="{{ old('first_name') }}" name="first_name" type="text" class="form-control" placeholder="First Name">
                                                </div>
                                                @error('first_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="form-inner">
                                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                                    <input value="{{ old('last_name') }}" name="last_name" type="text" class="form-control" placeholder="Last Name">
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
                                                        <input value="{{ old('phone') }}" name="phone" class="form-control" placeholder="Phone Number" type="text">
                                                    </div>
                                                </div>
                                                @error('phone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="form-inner">
                                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                    <input value="{{ old('email') }}" name="email" type="email" class="form-control" placeholder="Email">
                                                </div>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="form-inner">
                                                    <i class="fa fa-key" aria-hidden="true"></i>
                                                    <input value="{{ old('password') }}" name="password" type="password" class="form-control" placeholder="Password">
                                                </div>
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary">Create Account</button>
                                        </div>
                                        <div class="login_register-or">
                                            <div class="or"><span>OR</span></div>
                                            <div class="login_register-google login-button">
                                                <a href="{{ url('auth/google') }}">
                                                    <img src="{{ asset('assets') }}/img/google.svg">
                                                    <span>Sign up to Google</span>
                                                </a>
                                            </div>
                                            <div class="login_register-facebook login-button">
                                                <a href="{{ url('auth/facebook') }}">
                                                    <img src="{{ asset('assets') }}/img/Facebbok.svg">
                                                    <span>Sign up to Facebook</span>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- User coupon-code details--}}
                        <div class="card coupon-code" id="coupon-code">
                            <div class="card-header" >
                                <button class="btn btn-link coupon-code-btn @if(empty(Auth::user()->id)) collapsed @endif" type="button" data-toggle="collapse"
                                    data-target="#collapseFive" aria-expanded="@if(empty(Auth::user()->id)) false @else true @endif" aria-controls="collapseFIve">
                                    Coupon Code
                                </button>
                            </div>
                            <div id="collapseFive" class="collapse  @if(!empty(Auth::user()->id)) show @endif" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form id="coupon-form">
                                        @csrf
                                        <div class="shopping-cart-inner">
                                            <div class="shopping-coupon-code-block coupon-box">
                                                <div class="shopping-coupon-code">
                                                    <input type="text" class="form-control" placeholder="Coupon code" name="coupon_code" id="coupon-code">
                                                    <button type="button" id="apply-coupon">Apply Coupon</button>
                                                </div>
                                                <span class="text-danger" id="coupon_error"></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- User shipping address detail fill--}}
                        <div class="card delivery-address-block">
                            <div class="card-header" >
                                <button class="btn btn-link  collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Delivery Address
                                </button>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="nav nav-tabs" role="tablist">
                                        <div>
                                            <input id="optDaily" checked name="intervaltype" type="radio" data-target="#CreateNewAddressTab">
                                            <label for="optDaily">Create New</label>
                                        </div>
                                        <div class="ml-2">
                                            <input id="optWeekly" name="intervaltype" type="radio" data-target="#PickupFromOldAddressTab">
                                            <label for="optWeekly">Pickup</label>
                                        </div>
                                    </div>
                                    <div class="tab-content mt-3">
                                        <div id="CreateNewAddressTab" class="tab-pane active">
                                            <div class="form-group">
                                                <div class="form-inner">
                                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" placeholder="Name" name="name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inner form-inner-call">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                    <select class="custom-select" style="max-width: 90px;" name="phone_code">
                                                        <option selected="">+971</option>
                                                        <option value="1">+91</option>
                                                        <option value="2">+58</option>
                                                        <option value="3">+701</option>
                                                        <option value="4">+972</option>
                                                        <option value="5">+972</option>
                                                    </select>
                                                    <input type="text" class="form-control" placeholder="Phone number" name="phone">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inner">
                                                    <i class="fa fa-key" aria-hidden="true"></i>
                                                    <input type="password" class="form-control" placeholder="pincode" name="pin" maxlength="4" name="zipcode">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inner">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <textarea placeholder="Address1" class="form-control" name="w3review" rows="4" cols="50" name="address_line_one"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inner">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <textarea placeholder="Address2" class="form-control" name="w3review" rows="4" cols="50" name="address_line_one"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inner">
                                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" placeholder="City / District / Town">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="PickupFromOldAddressTab" class="tab-pane">
                                            <div class="delivery-Address">
                                                @foreach($addresses as $address)
                                                    <div class="delivery-Address-inner">
                                                        <div class="delivery-Address-input">
                                                            <input type="radio" id="Address" name="text" value="{{$address->id}}">
                                                        </div>
                                                        <div class="delivery-Address-text">
                                                            <h5>{{$address->company_name}} <span class="delivery-label">@if($address->address_as == 1) Home @elseif($address->address_as == 2) Offer @else Other @endif </span><span class="delivery-no">{{$address->phone}}</span></h5>
                                                            <p> {{ $address->address_line_one }},{{ $address->city->name }}, {{ $address->city->state->name }},{{ $address->city->country->name }}, {{ $address->zipcode}} </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="checkout-continue">
                                        <button class="btn btn-info checkout-continue-btn" type="submit">Continue</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card Payment-block">
                            <div class="card-header">
                                <button class="btn btn-link collapsed payment-btn" type="button" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Payment Options
                                </button>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="Payment-card">
                                        <div class="Payment-inner">
                                            <div class="Payment-input">
                                                <input type="radio" id="Address" name="text" value="">
                                            </div>
                                            <div class="Payment-text"> <p>stripe</p> </div>
                                        </div>
                                        <div class="Payment-inner">
                                            <div class="Payment-input">
                                                <input type="radio" id="Address" name="text" value="">
                                            </div>
                                            <div class="Payment-text"> <p>paypal</p> </div>
                                        </div>
                                    </div>
                                    <div class="payment-continue">
                                        <button class="btn btn-info" type="submit">Continue Payment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                    </div>

                </div>

                <div class="checkout-right">
                    <div class="shopping-cart-total-details">
                        <h3>PRICE DETAILS</h3>
                        <div class="shopping-cart-total-details-inner">
                            <ul>
                                <li class="total-price"><span class="left">Price</span><span class="right">₹1000</span></li>
                                <li class="total-discount"><span class="left">coupon discount</span><span class="right">₹<span id="coupon_amount">{{Session::get('discount')}}</span></span></li>
                                <li class="total-tax"><span class="left">Tax</span><span class="right">₹10</span></li>
                                <li class="total-sub"><span class="left">sub Total</span><span class="right">₹1060</span></li>
                                <li class="total"><span class="left">Total Amount</span><span class="right">₹1060</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- defind script page level --}}
@section('page-script')
    <script>
        $(document).ready(function () {

            /* Auth check */
            var auth = "{{ Auth::check() }}";
            if (auth) {
                $('#login-signup-block').hide();
            }else{
                $('#coupon-code').hide();
            }

            $('input[name="intervaltype"]').click(function () {
                $(this).tab('show');
                $(this).removeClass('active');
            });
        });

        $('#apply-coupon').click(function(){
            var couponCode = $('#coupon-code').val();
            if(couponCode == '')
            {
                toastr.error("{{session('toast_error')}}","Please Enter Coupon Code");
            }
            else
            {
                var formdata = $("#coupon-form").serializeArray();
                $.ajax({
                    url:'{{ url("apply-coupon-code")}}',
                    type:'POST',
                    data:formdata,
                    success:function(response)
                    {
                        var status = response.status;
                        if(status == 1)
                        {
                        location.reload(true);
                        $("#coupon_amount").text(response.discount);
                        toastr.success("{{session('toast_success')}}","Coupon Discount Apply SuccessFully");
                        }
                        else
                        {
                        $("#coupon_error").html("Coupon code not found");
                        $("#coupon_amount").text(0);
                        }

                    }
                });
            }
        });

        $('.checkout-continue-btn').click(function () {
            $('.Payment-block .payment-btn').trigger('click');
        });

        /* create account */
        $('#signup-form').submit(function(e) {
            e.preventDefault();
            var formdata = $('#signup-form').serializeArray();
            $.ajax({
                url: "{{__url('ajex/signup')}}",
                type: "POST",
                data:  formdata,
                success: function(data){
                    if (data.success) {
                        toastr.success("{{session('toast_success')}}", data.success);
                        $('#login-signup-block').hide();
                        $('#coupon-code').show();
                        $('#coupon-code .coupon-code-btn').trigger('click');
                    }else{
                        toastr.error("{{session('toast_error')}}", data.error);
                    }
                }
            });
        })
    </script>
@endsection
