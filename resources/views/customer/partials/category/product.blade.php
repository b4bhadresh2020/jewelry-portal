<div class="grid-list-wrapper">
    <div class="grid-list-inner">
    <div class="grid-list-block">
        <div class="grid-list-tab">
        <div class="tab">
            <button class="tablinks grid grid-list-button" onclick="openCity(event, 'grid')">
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
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="product-wrapper-content">
                <div class="product-image">
                    <a href="#" class="product-thumbnail">
                    <img src="{!! @getMediaUrlToMedia($product->media) !!}">
                    <img class="product-image-hover" src="{!! @getMediaUrlToMedia($product->media) !!}">
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
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
                        Off]</span></span>
                    </div>
                </div>
                </div>
            </div>
        @endforeach
        {{-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product2.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                </a>
                <div class="product-icon">
                <div class="product-wishlist">
                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
                </div>
            </div>
            <div class="product-description">
                <div class="product-title">
                <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                <span class="product-price">₹21,350 <span
                    class="product-regular-price"><del>₹26,688</del></span></span>
                <small>You Save</small>
                <span class="product-price-save">₹5,338 <span class="product-discount">[20%
                    Off]</span></span>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product4.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                </a>
                <div class="product-icon">
                <div class="product-wishlist">
                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
                </div>
            </div>
            <div class="product-description">
                <div class="product-title">
                <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                <span class="product-price">₹21,350 <span
                    class="product-regular-price"><del>₹26,688</del></span></span>
                <small>You Save</small>
                <span class="product-price-save">₹5,338 <span class="product-discount">[20%
                    Off]</span></span>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product4.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                </a>
                <div class="product-icon">
                <div class="product-wishlist">
                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
                </div>
            </div>
            <div class="product-description">
                <div class="product-title">
                <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                <span class="product-price">₹21,350 <span
                    class="product-regular-price"><del>₹26,688</del></span></span>
                <small>You Save</small>
                <span class="product-price-save">₹5,338 <span class="product-discount">[20%
                    Off]</span></span>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product1.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                </a>
                <div class="product-icon">
                <div class="product-wishlist">
                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
                </div>
            </div>
            <div class="product-description">
                <div class="product-title">
                <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                <span class="product-price">₹21,350 <span
                    class="product-regular-price"><del>₹26,688</del></span></span>
                <small>You Save</small>
                <span class="product-price-save">₹5,338 <span class="product-discount">[20%
                    Off]</span></span>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product2.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                </a>
                <div class="product-icon">
                <div class="product-wishlist">
                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
                </div>
            </div>
            <div class="product-description">
                <div class="product-title">
                <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                <span class="product-price">₹21,350 <span
                    class="product-regular-price"><del>₹26,688</del></span></span>
                <small>You Save</small>
                <span class="product-price-save">₹5,338 <span class="product-discount">[20%
                    Off]</span></span>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product1.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                </a>
                <div class="product-icon">
                <div class="product-wishlist">
                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
                </div>
            </div>
            <div class="product-description">
                <div class="product-title">
                <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                <span class="product-price">₹21,350 <span
                    class="product-regular-price"><del>₹26,688</del></span></span>
                <small>You Save</small>
                <span class="product-price-save">₹5,338 <span class="product-discount">[20%
                    Off]</span></span>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product2.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                </a>
                <div class="product-icon">
                <div class="product-wishlist">
                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
                </div>
            </div>
            <div class="product-description">
                <div class="product-title">
                <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                <span class="product-price">₹21,350 <span
                    class="product-regular-price"><del>₹26,688</del></span></span>
                <small>You Save</small>
                <span class="product-price-save">₹5,338 <span class="product-discount">[20%
                    Off]</span></span>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product4.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                </a>
                <div class="product-icon">
                <div class="product-wishlist">
                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
                </div>
            </div>
            <div class="product-description">
                <div class="product-title">
                <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                <span class="product-price">₹21,350 <span
                    class="product-regular-price"><del>₹26,688</del></span></span>
                <small>You Save</small>
                <span class="product-price-save">₹5,338 <span class="product-discount">[20%
                    Off]</span></span>
                </div>
            </div>
            </div>
        </div>
        </div> --}}
    </div>
    </div>
    <div id="list" class="tabcontent">
    <div class="list-wrapper">
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product1.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
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
                    <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product2.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
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
                    <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product3.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product1.jpg">
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
                    <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product4.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
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
                    <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product1.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
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
                    <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product1.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
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
                    <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product2.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
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
                    <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product3.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product1.jpg">
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
                    <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product4.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
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
                    <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="product-wrapper-content">
            <div class="product-image">
                <a href="#" class="product-thumbnail">
                <img src="{{asset('assets')}}/img/product1.jpg">
                <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
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
                    <h6><a href="#">The Mathias Diamond Pendant</a></h6>
                </div>
                <div class="product-price">
                    <span class="product-price">₹21,350 <span
                        class="product-regular-price"><del>₹26,688</del></span></span>
                    <small>You Save</small>
                    <span class="product-price-save">₹5,338 <span class="product-discount">[20%
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
        </div>
    </div>
    </div>

</div>