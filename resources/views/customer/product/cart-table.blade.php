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
        @forelse ($carts as $cart)
            @php
                $amount = $cart->price * $cart->quantity;
                $totalAmount = $totalAmount + $amount;
            @endphp
                <tr>
                    <td class="cart-product"><a href="#">
                        <img src="{{ getMediaUrlToMedia($cart->attributes->attribute_product->defaultImage->media[0]) }}" alt=""></a>
                    </td>
                    <td class="product-name"><a href="#">{{$cart->name}}</a>
                        <a class="custom-cartpage-color">
                            @foreach ($cart->attributes->attribute_product->productVariation as $variation)
                                <div class="data-sheet" id="data-sheet-item{{ $variation->attribute->id }}">
                                    <span><b>{{ $variation->attribute->{'name:'.$locale} }}</b></span>
                                    @foreach($cart->attributes->attributes as $option_id)
                                        @foreach($variation->attribute->option as $options)
                                            @if($option_id == $options->id)
                                                @if (strtolower($variation->attribute->{'name:'.$locale})  != "color")
                                                    <span id="data-sheet-item-val{{ $options->id }}"><b>{{ $options->{'name:'.$locale} }}</b></span>
                                                @else
                                                    <span id="data-sheet-item-val{{ $options->id }}">
                                                        <span class="swatch" style="background-color:{{ $options->{'name:'.$locale} }}"></span>
                                                    </span>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            @endforeach
                        </a>
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
                    <td class="product-price"><span class="amount">₹{{$cart->price}}</span></td>
                    <td class="product-quantity">
                        <div class="def-number-input number-input">
                            <button onclick="minusQuantity({{$cart->id}},{{$cart->price}})" class="minus"></button>

                            <input class="product-id" name="product_id" type="hidden" value="{{$cart->id}}">
                            <input class="quantity" min="0" name="quantity" value="{{$cart->quantity}}" type="number" id="quantity{{$cart->id}}">

                            <button onclick="plusQuantity({{$cart->id}},{{$cart->price}})" class="plus"></button>
                        </div>
                    </td>
                    <td class="product-subtotal"><span class="amount">₹<span class="total-amount"  id="amount{{$cart->id}}">{{$amount}}</span></span></td>
                    <td class="product-remove"><a href="javascript:;" onclick="removeCart({{$cart->id}})"><i class="fa fa-times"></i></a></td>
                </tr>
        @empty
            <tr class="text-center">
                <td colspan="7">Your cart is empty</td>
            </tr>
        @endforelse
    </tbody>
</table>
