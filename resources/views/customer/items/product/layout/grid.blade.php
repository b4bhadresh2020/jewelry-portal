@php
    $productLink = url('product/'.$productAttribute->product->slug);
    if(!$productAttribute->is_default){
        $productLink .= "/".$productAttribute->sku;
    }
@endphp
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
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
                    <a href="javascript:void(0)"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
            </div> --}}
        </div>
        <div class="product-description">
            <div class="product-title">
                <h6><a href="{{ $productLink }}" class="text-capitalize">{{ $productAttribute->product->{'title:'.$locale} }}</a></h6>
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
    </div>
</div>
