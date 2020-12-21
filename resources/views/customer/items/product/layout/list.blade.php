@php
    $productLink = url('product/'.$productAttribute->product->slug);
    if(!$productAttribute->is_default){
        $productLink .= "/".$productAttribute->sku;
    }
@endphp
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="product-wrapper-content">
        <div class="product-image">
            <a href="{{ $productLink }}" class="product-thumbnail">
                <img class="lazyload" src="{{ PRODUCT_LOADER_GIF }}" data-src="{{ @getMediaUrlToMedia($productAttribute->defaultImage->media[0]) }}" >

                @if (isset($productAttribute->imagesWithoutDefault[0]->media[0]))
                    <img class="lazyload product-image-hover " src="{{ PRODUCT_LOADER_GIF }}" data-src="{{ @getMediaUrlToMedia($productAttribute->imagesWithoutDefault[0]->media[0]) }}" >
                @else
                    <img class="lazyload product-image-hover " src="{{ PRODUCT_LOADER_GIF }}" data-src="{{ @getMediaUrlToMedia($productAttribute->defaultImage->media[0]) }}" >
                @endif
            </a>
            {{-- <div class="product-icon">
                <div class="product-wishlist">
                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
            </div> --}}
        </div>
        <div class="product-description">
            <div class="product-list-des">
                <div class="product-title">
                    <h6><a href="{{ $productLink }}">{{ $productAttribute->product->{'title:'.$locale} }}</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">${{ $productAttribute->productPrice->sell_price }}
                        <span class="product-regular-price"><del>${{ $productAttribute->productPrice->mrp }}</del></span>
                    </span>
                    <small>You Save</small>
                    @if ($productAttribute->productPrice->isBenefit())
                        <span class="product-price-save">${{ $productAttribute->productPrice->benefitInValue() }}
                            <span class="product-discount">[{{ $productAttribute->productPrice->benefitInPercentage() }}% Off]</span>
                        </span>
                    @endif
                </div>
            </div>
            {{-- <div class="product-list-button">
                <div class="product-list-add-to-cart">
                    <a href="#">Add To Cart</a>
                </div>
                <div class="product-list-buy-now">
                    <a href="#">Buy Now</a>
                </div>
            </div> --}}
        </div>
    </div>
</div>
