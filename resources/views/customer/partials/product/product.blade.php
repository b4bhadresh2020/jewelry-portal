{{-- Products --}}
<div id="all_product">
    <div class="grid-list-wrapper">
        <div class="grid-list-inner">
            <div class="grid-list-block">
                <div class="grid-list-tab">
                    <div class="tab">
                        <button class="tablinks grid grid-list-button active" onclick="openCity(event, 'grid')">
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        </button>
                        <button class="tablinks list grid-list-button" onclick="openCity(event, 'list')">
                        <i class="fa fa-th-list" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="tab-total-product">
                        <p>There are 15 products.</p>
                    </div>
                </div>
                <div class="grid-list-dropdown">
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Relevance
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Relevance</a>
                        <a class="dropdown-item" href="#">Name, A to Z</a>
                        <a class="dropdown-item" href="#">Name, Z to A</a>
                        <a class="dropdown-item" href="#">Price, low to high</a>
                        <a class="dropdown-item" href="#">Price, high to low</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="grid" class="tabcontent">
            <div class="grid-wrapper">
                <div class="row">
            
                @foreach($products as $product)
                    @php
                            $sellingPrice = $product->productAttribute[0]->productPrice->sell_price;
                            $mrp = $product->productAttribute[0]->productPrice->mrp;
                            $discountPrice = $mrp - $sellingPrice;
                            $discount = floor($discountPrice*100/$mrp);
                    @endphp
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="product-wrapper-content">
                            <div class="product-image">
                                <a href="#" class="product-thumbnail">
                                <img src="{!! @getMediaUrlToMedia($product->productAttribute[0]->defaultImage->media[0]) !!}">
                                <img class="product-image-hover" src="{!! @getMediaUrlToMedia($product->productAttribute[0]->images[1]->media[0]) !!}">
                                </a>
                                <div class="product-icon">
                                <div class="product-wishlist">
                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                                </div>
                            </div>
                            <div class="product-description">
                                <div class="product-title">
                                <h6><a href="#">{!! $product->title !!}</a></h6>
                                </div>
                                <div class="product-price">
                                <span class="product-price">₹{{$sellingPrice}}
                                <span class="product-regular-price"><del>₹{{$mrp}}</del></span></span>
                                <small>You Save</small>
                                <span class="product-price-save">₹{{$discountPrice}}<span class="product-discount">[{{$discount}}%
                                    Off]</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <div id="list" class="tabcontent">
            <div class="list-wrapper">
                <div class="row">
                @foreach($products as $product)
                @php
                        $sellingPrice = $product->productAttribute[0]->productPrice->sell_price;
                        $mrp = $product->productAttribute[0]->productPrice->mrp;
                        $discountPrice = $mrp - $sellingPrice;
                        $discount = floor($discountPrice*100/$mrp);
                @endphp
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="product-wrapper-content">
                        <div class="product-image">
                            <a href="#" class="product-thumbnail">
                            <img src="{{@getMediaUrlToMedia($product->productAttribute[0]->defaultImage->media[0])}}">
                            <img class="product-image-hover" src="{{ @getMediaUrlToMedia($product->productAttribute[0]->images[1]->media[0]) }}">
                            </a>
                            <div class="product-icon">
                                <div class="product-wishlist">
                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-description">
                            <div class="product-list-des">
                            <div class="product-title">
                                <h6><a href="#">{{$product->title}}</a></h6>
                            </div>
                            <div class="product-price">{{$sellingPrice}} 
                                <span class="product-regular-price"><del>₹{{$mrp}}</del></span></span>
                                <small>You Save</small>
                                <span class="product-price-save">₹{{$discountPrice}}<span class="product-discount">[{{$discount}}%
                                    Off]</span></span>
                            </div>
                            </div>
                            <div class="product-list-button">
                            <div class="product-list-add-to-cart">
                                <a href="#">Add To Cart</a>
                            </div>
                            <div class="product-list-buy-now">
                                <a href="#">Buy Now</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    
    </div>
</div>