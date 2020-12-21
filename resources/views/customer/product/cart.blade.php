@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Home')

{{-- defind style page level --}}
@section('page-style')
@endsection

{{-- defind content --}}
@section('content')
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="breadcrumb-title">Jewellery Cart</div>
            <div class="breadcrumb-ul">
                <ul>
                    <li class="breadcrumb-nav"><a href="#">Home</a></li>
                    <li class="breadcrumb-nav active"><a href="#">cart</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Load Cart Data--}}
    <div class="shopping-cart-wrapper">
        <div class="container">
            <div class="shopping-cart">
                <div class="shopping-cart-block">
                    <h3>My Cart</h3>
                    <div class="table-responsive">
                        @php
                            $totalAmount = 0;
                        @endphp
                        <table class="table" id="cart">
                            <thead>
                                <tr>
                                    <th scope="col">Images</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($carts as $cart)
                                    @php
                                        $amount = $cart->price * $cart->quantity;
                                        $totalAmount = $totalAmount + $amount;
                                    @endphp
                                        <tr>
                                            <td class="cart-product">
                                                <a href="">
                                                    <img class="lazyload" src="{{ PRODUCT_LOADER_GIF }}" data-src="{{ getMediaUrlToMedia($cart->conditions->defaultImage->media[0]) }}">
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <a class="text-left" href="#">{{$cart->name}}</a>
                                                <div class="mt-2">
                                                    @foreach ($cart->conditions->productVariation as $variation)
                                                        <span style="display: block">
                                                            <b>{{ $variation->attribute->{'name:'.$locale} }}</b> :
                                                            <b>{{ $variation->options->{'name:'.$locale} }}</b>
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">
                                                    @if($cart->attributes->make_to_order == 1)
                                                        MAKE TO ORDER
                                                    @else
                                                        IN STOCK
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">${{$cart->price}}</span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="def-number-input number-input">
                                                    <button class="minus" onclick="minusQuantity({{$cart->id}},{{$cart->price}})"></button>
                                                    <input class="product-id" name="product_id" type="hidden" value="{{$cart->id}}">
                                                    <input class="quantity" min="0" name="quantity" value="{{$cart->quantity}}" type="number" id="quantity{{$cart->id}}">
                                                    <button class="plus" onclick="plusQuantity({{$cart->id}},{{$cart->price}})"></button>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount">
                                                    $<span class="total-amount"  id="amount{{$cart->id}}">{{$amount}}</span>
                                                </span>
                                            </td>
                                            <td class="product-remove">
                                                <a href="javascript:;" onclick="removeCart(this, {{$cart->id}})"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="7">Your cart is empty</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <form id="coupon-form">
                        <div class="shopping-cart-inner">
                            <div class="shopping-coupon-code-block"></div>
                            <div class="shopping-clear shopping-update">
                                <a onclick="clearCart()" href="javascript:;">Clear Cart</a>
                            </div>
                            <div class="shopping-update">
                                <a href="javascript:;" id="update-cart">Update Cart</a>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Load Shopping Cart Details --}}
                <div class="shopping-cart-total">
                    <div class="shopping-cart-total-details">
                        <h3>PRICE DETAILS</h3>
                        <div class="shopping-cart-total-details-inner">
                            <ul>
                                <li class="total-price">
                                    <span class="left">Sub Price</span>
                                    <span class="right">₹<span id="sub-price">{{$totalAmount}}</span></span>
                                </li>
                                <li class="total-discount">
                                    <span class="left">Coupon Discount</span>
                                    <span class="right">₹<span id="coupon-discount"> 0</span></span>
                                </li>
                                <li class="total">
                                    <span class="left">Estimate Total</span>
                                    <span class="right" >₹<span id="estimate-total">{{$totalAmount}}</span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="{{url('checkout')}}"  @if(empty($carts->toArray())) style="pointer-events: none;" @endif>
                        <button type="button" class="checkout-btn @if(empty($carts->toArray())) cart-btn-disabled @endif" id="checkout">Checkout</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- defind script page level --}}
@section('page-script')
    <script>
        /** use to clear cart */
        function clearCart(){
            $.get('{{ __url("clear-cart") }}', function(cartCounter) {
                toastr.success("{{session('toast_success')}}","Cart Clear Successfully");
                if(cartCounter == 0){
                    $(".shopping-cart-block tbody").html('<tr class="text-center"><td colspan="7">Your cart is empty</td></tr>');
                    $("#sub-price").text(0);
                    $("#estimate-total").text(0);
                }else{
                    handlePriceDetails();
                }
            });
        }

        /** this function call product remove add to cart */
        function removeCart(el, cartId)
        {
            $.ajax({
                url:'{{ __url("remove-cart") }}'+'/'+cartId,
                type:'GET',
                success:function(cartCounter)
                {
                    toastr.success("{{session('toast_success')}}","Product Remove Successfully");
                    $(el).parents('tr').remove();
                    $('#cart-counter').text(cartCounter);
                    if(cartCounter == 0){
                        $(".shopping-cart-block tbody").html('<tr class="text-center"><td colspan="7">Your cart is empty</td></tr>');
                        $("#sub-price").text(0);
                        $("#estimate-total").text(0);
                    }else{
                        handlePriceDetails();
                    }
                }
            });
        }

        function handlePriceDetails(){
            var grandTotal = 0;
            $(".total-amount").each(function(){
                grandTotal += parseInt($(this).text());
            });
            $("#sub-price").text(grandTotal);
            $("#estimate-total").text(grandTotal);
        }

        /** this function call quantity increment in add to cart */
        function plusQuantity(id, price)
        {
            var quantity = '#quantity'+id;
            $(quantity).val(parseInt($(quantity).val()) + 1);
            var total = price * $(quantity).val();
            $('#amount' + id).text(total);
            handlePriceDetails();
        }

        /** this function call quantity decrement in add to cart */
        function minusQuantity(id,price)
        {
            var quantity = '#quantity' + id;
            if ($(quantity).val() > 1) {
                $(quantity).val(parseInt($(quantity).val()) - 1);
                var total = price*$(quantity).val();
                $('#amount' + id).text(total);
                handlePriceDetails();
            }else{
                toastr.error("{{session('toast_success')}}","Minimum 1 Quantity Must Be Required");
            }
        }

        /** this function call quantity update in add to cart */
        $('#update-cart').on("click",function(){
            var id = [], quantity = [],
                i = 0, j = 0;

            $(".product-id").each(function(){
                id[i] = $(this).val();
                i++;
            });

            $(".quantity").each(function(){
                quantity[j] =  $(this).val();
                j++;
            });

            var myQty = {id: id, quantity: quantity};
            $.getJSON('{{ __url("update-qty-to-cart") }}', myQty, function(json, textStatus) {
                toastr.success("{{session('toast_success')}}", "Cart Update Successfully");
            });
        });

        /** this function call checkout button click to grand amount store session */
        $('#checkout').click(function(){
            var grandAmount =  {'amount':$("#grand-amount").text()};
            $.getJSON('{{ __url("add-grand-amount") }}', grandAmount, function(json, textStatus) {});
        });

        /** this function call to check coupon code verification */
        $('#apply-coupon').click(function(){
            var couponCode = $('#coupon-code').val();
            if(couponCode == ''){
                toastr.error("{{session('toast_error')}}","Please Enter Coupon Code");
            }
            else{
                var formdata = $("#coupon-form").serializeArray()
                $.ajax({
                    url:'{{ __url("apply-coupon-code")}}',
                    type:'POST',
                    data:formdata,
                    success:function(response)
                    {
                        var status = response.status;
                        if(status == 1) {
                            $('#coupon-discount').text(response.discount);
                            $('#grand-amount').text($('#grand-amount').text()-response.discount);
                            toastr.success("{{session('toast_success')}}","Coupon Discount Apply SuccessFully");
                        }
                        else if(status == 2) {
                        toastr.error("{{session('toast_error')}}","Coupon Code Not Found");
                        }
                        else{
                            toastr.error("{{session('toast_error')}}","Please Login");
                        }
                    }
                });
            }
        });
    </script>
@endsection
