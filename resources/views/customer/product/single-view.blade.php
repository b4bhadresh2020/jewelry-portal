@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Home')

{{-- defind style page level --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/review.css')}}">
    @endsection

{{-- defind content --}}
@section('content')
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="breadcrumb-title">Jewellery Product</div>
            <div class="breadcrumb-ul">
                <ul>
                    <li class="breadcrumb-nav"><a href="#">Home</a></li>
                    <li class="breadcrumb-nav"><a href="">Product</a></li>
                    <li class="breadcrumb-nav active"><a href="">{{ $defaultAttribute->product->{'title:'.$locale} }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-page">
        <div class="container">
            <div class="product-page-wrapper">
                <div class="row">
                    {{-- Leftbar : images,gif,360 video --}}
                    <div class="col-lg-5 col-md-12">
                        <div class="product-page-left">
                            <div class="product-page-left-signal">
                                <a href="javascript:;">
                                    <img class="default-img" src="{{ getMediaUrlToMedia($defaultAttribute->defaultImage->media[0]) }}">
                                    {{-- <iframe width="500px" height="500px" src="https://bg.prolanceit.in/media/vision360.html?d=H27H102568" frameborder="0"></iframe> --}}
                                </a>
                                <div class="product-label">
                                    <div class="product-label-inner">
                                        <span>New</span>
                                    </div>
                                </div>
                            </div>
                            <div class="multi-product LoadOwlCarousel">
                                {!! $owlCarouselData !!}
                            </div>
                        </div>
                    </div>

                    {{-- Rightbar : Filter section, Product Availability, Sort Description--}}
                    <div class="col-lg-7 col-md-12">
                        <div class="product-page-right">
                            {{-- Product Title Load Language Wise --}}
                            <div class="productpage-title">
                                <h2>{{ $defaultAttribute->product->{'title:'.$locale} }}</h2>
                            </div>
                            {{-- Product Rating bar --}}
                            <div class="productpage-rating">
                                @for ($i = 1; $i <= ceil($defaultAttribute->review()->avg('rating')); $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                @for ($i = (5 - ceil($defaultAttribute->review()->avg('rating'))); $i >= 1; $i--)
                                    <i class="fa fa-star-o"></i>
                                @endfor
                            </div>

                            {{-- Load price and sell price --}}
                            <div class="productpage-price">
                                <span class="price">{{ $defaultAttribute->productPrice->sell_price }}</span>
                                <del class="old-price">{{ $defaultAttribute->productPrice->mrp }}</del>
                            </div>

                            {{-- Load Product Availability --}}
                            <div class="productpage-stock">
                                <h4>Availability :
                                    <span class="stock-status">
                                        <span class="in-stock-label" style="display:@if (!$defaultAttribute->isStockAvailable()) none @endif">IN STOCK</span>
                                        <span class="make-to-order-label text-success" style="display:@if ($defaultAttribute->isStockAvailable()) none @endif">MAKE TO ORDER</span>
                                    </span>
                                </h4>
                            </div>

                            {{-- Load Sort Description --}}
                            <div class="productpage-desc">
                                <p>{{ $defaultAttribute->product->sort_description }}</p>
                            </div>

                            {{-- Load Filter Section Like color, Metal, etc.. Wise --}}
                            <form id="form-product-filter-variation">
                                <input type="hidden" name="product_attribute_id" value="{{ $defaultAttribute->id }}" class="product_attribute_id">
                                <input type="hidden" name="make_to_order" value="@if($defaultAttribute->isStockAvailable() == 0) 1 @else 0 @endif" class="make_to_order">

                                @foreach ($defaultAttribute->product->attributes() as $asignAttribute)
                                    @php
                                        $default_option_id = $defaultAttribute->productVariation->where('attribute_id', $asignAttribute->attribute->id )->first()->option_id;
                                    @endphp

                                    @if (strtolower($asignAttribute->attribute->key) != DIAMOND_QUALITY)
                                        <div class="productpage-size">
                                            <span>{{ $asignAttribute->attribute->{'name:'.$locale} }}</span>
                                            <div class="form-group">
                                                <select
                                                    class="form-control filter-product-variation-select"
                                                    onchange="filterOtherProductVariation(this)"
                                                    name="attribute[{{ $asignAttribute->attribute->id }}]"
                                                    id="attribute{{ $asignAttribute->attribute->id }}"
                                                    data-id="{{ $asignAttribute->attribute->id }}"
                                                    data-type="select">
                                                    @foreach ($asignAttribute->attribute->option as $option)
                                                        <option @if($default_option_id == $option->id) selected @endif value="{{ $option->id }}">{{ $option->{'name:'.$locale} }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @else
                                        <input
                                            id="diamondQuality"
                                            type="hidden"
                                            value="{{ $default_option_id }}"
                                            name="attribute[{{ $asignAttribute->attribute->id }}]" />
                                        <div class="productpage-diamond-quantity">
                                            <span>{{ $asignAttribute->attribute->{'name:'.$locale} }}</span>
                                            <div class="productpage-diamond-quantity-inner">
                                                @foreach ($asignAttribute->attribute->option as $option)
                                                    <div class="diamond-quantity-block  @if($default_option_id == $option->id) active @endif">
                                                        <a href="javascript:void(0)" attribute-id="{{ $asignAttribute->attribute->id }}" data-id="{{ $option->id }}" onclick="filterDiamondQualityWise(this)">
                                                            <img src="{{ url('assets') }}/img/diamond-quantity.svg">
                                                            <span>{{ $option->{'name:'.$locale} }}</span>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                {{-- Product avaibility status --}}
                                <div class="number-items-available mb-2">
                                    <h5 class="not-available-product-msg" style="display:none">
                                        <span class="text-danger">This type of product not avalible please create custom</span>
                                    </h5>
                                </div>

                                {{-- Below functionality is Related to quantity changes and add to cart --}}
                                <div class="productpage-quantity-wrapper">
                                    <span>Quantity</span>
                                    <div class="productpage-quantity">
                                        <div class="productpage-quantity-inner">
                                            <div class='productpage-quantity-block'><input type='number' name='quantity' min='1' value='1'></div>
                                            <div class="productpage-quantity-icon">
                                                <div class='productpage-quantity-decrease'>
                                                    <a href="javascript:;"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
                                                </div>
                                                <div class='productpage-quantity-increase'>
                                                    <a href="javascript:;"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="productpage-icon">
                                            <div class="productpage-add-to-cart">
                                                <a class="addToCart" id="addToCart"  href="javascript:;" @if (!$defaultAttribute->isStockAvailable()) disabled @endif>
                                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i> Add To Cart
                                                </a>
                                            </div>
                                            <div class="productpage-customization">
                                                <a class="customization-inner" id="customization" href="javascript:;">
                                                    <i class="fa fa-edit" aria-hidden="true"></i> Customization
                                                </a>
                                            </div>
                                            @if(!empty(Auth::user()->id))
                                                <div class="productpage-wishlist">
                                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                                </div>
                                            @endif
                                            <div class="productpage-wishlist">
                                                <input type="checkbox" name="engraving" id="engraving" value="1">&nbsp; ENGRAVING
                                            </div>
                                            <div class="productpage-wishlist">
                                                <input type="checkbox"  id="apply_all" value="1">&nbsp; Apply All
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--ENGRAVING ---}}
                                <div class="productpage-social-sharing productpage-engraving">
                                    <span>ENGRAVING</span>
                                    <div id="all-engraving">
                                        <div class="engraving-box" id="engraving1">
                                            <input type="text" class="form-control engraving-form" placeholder="Enter engraving name" name="engraving_name[]" id="engraving-name1">
                                            <select name="engraving_font[]" class="form-control engraving-form" onchange="fontStyle(this.value,1)" id="engraving-font1">
                                                <option value="Nunito Sans">Select Font</option>
                                                @foreach($fonts as $font)
                                                    <option value="{{$font}}">{{$font}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            {{-- Social sharing Icons --}}
                            <div class="productpage-social-sharing">
                                <span>Share</span>
                                <div class="footer-social">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li class="rss">
                                            <a href="#" target="_blank"><i class="fa fa-rss" aria-hidden="true"></i></a>
                                        </li>
                                        <li class="youtube"><a href="#" target="_blank"> <i class="fa fa-youtube" aria-hidden="true"></i></a>
                                        </li>
                                        <li class="googleplus">
                                            <a href="#" target="_blank"><i class="fa fa-google" aria-hidden="true"></i></a>
                                        </li>
                                        <li class="pinterest">
                                            <a href="#" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- Static policy --}}
                            <div class="productpage-reassurance">
                                <ul>
                                    <li>
                                        <img src="{{ url('assets') }}/img/security-policy.png">Security policy (edit with Customer
                                        reassurance module)
                                    </li>
                                    <li>
                                        <img src="{{ url('assets') }}/img/delivery-policy.png">Delivery policy (edit with Customer
                                        reassurance module)
                                    </li>
                                    <li>
                                        <img src="{{ url('assets') }}/img/return-policy.png">Return policy (edit with Customer
                                        reassurance module)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Load Other Details In Tabs Like [Description, Details, Reviews] --}}
            <div class="producttab-block">
                {{-- All Tab List --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="des-tab" data-toggle="tab" href="#des" role="tab">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab">Reviews</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    {{-- Tab : 1 : Product Description --}}
                    <div class="tab-pane fade show active" id="des" role="tabpanel" aria-labelledby="des-tab">
                        {!! $defaultAttribute->product->description !!}
                    </div>

                    {{-- Tab : 2 : Data sheet --}}
                    <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                        <div class="detail-block">
                            <div class="detail-reference"><label>Condition</label><span>New product</span></div>
                            <div class="detail-data-sheet">
                                <span>Data sheet</span>
                                <div class="detail-data-sheet-inner">
                                    @foreach ($defaultAttribute->productVariation as $variation)
                                        @if (strtolower($variation->attribute->{'name:'.$locale}) != "color")
                                            <div class="data-sheet" id="data-sheet-item{{ $variation->attribute->id }}">
                                                <span class="left">{{ $variation->attribute->{'name:'.$locale} }}</span>
                                                <span class="right" id="data-sheet-item-val{{ $variation->attribute->id }}">{{ $variation->options->{'name:'.$locale} }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tab : 3 : Product Review --}}
                    @include('customer.product.partials.reviews-tab',[
                        'defaultAttribute' => $defaultAttribute
                    ])
                </div>
            </div>

            {{-- Load Related Products --}}
            @include('customer.partials.product.related', [
                "relatedProducts" => $defaultAttribute->product->relatedProducts()
            ])
        </div>
    </div>
@endsection

{{-- defind script page level --}}
@section('page-script')
    {{-- Load Script --}}
    @include('customer.product.partials.single-product-script')
@endsection

