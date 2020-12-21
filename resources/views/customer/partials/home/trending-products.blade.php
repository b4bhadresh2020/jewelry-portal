@php
    use App\Product;
@endphp
<div class="tabproduct-wrapper">
    <div class="container">
        <div class="title-pagin-block">
            <div class="title-wrapper">
                <div class="title-inner">
                    <h2>TRENDING PRODUCTS</h2>
                </div>
            </div>
            <div class='pagin'>
                <button class='pagin-btn btn-prev tab'><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                <button class='pagin-btn btn-next tab'><i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="tabproduct-inner">
            <div class="tabproduct-tab">
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'Featured-Products')">Featured-Products</button>
                    <button class="tablinks" onclick="openCity(event, 'New-Arrivals')">New Arrivals</button>
                    <button class="tablinks" onclick="openCity(event, 'Best-sellers')">Best sellers</button>
                </div>
                <div id="Featured-Products" class="tabcontent">
                    <div class="product-block">
                        <div class="tab-featured-product owl-carousel">
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product1.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product1.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product3.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product4.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product4.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product3.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product4.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product3.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="New-Arrivals" class="tabcontent">
                    <div class="product-block">
                        <div class="tab-new-product owl-carousel">
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product1.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product1.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product3.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product4.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product4.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product3.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product4.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product3.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Best-sellers" class="tabcontent">
                    <div class="product-block">
                        <div class="tab-best-product owl-carousel">
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product1.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product1.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product3.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product4.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product4.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product3.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product4.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='item'>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product3.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product2.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-wrapper-content">
                                    <div class="product-image">
                                        <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}" class="product-thumbnail">
                                        <img src="{{asset('assets')}}/img/product2.jpg">
                                        <img class="product-image-hover" src="{{asset('assets')}}/img/product3.jpg">
                                        </a>
                                        <div class="product-icon">
                                            <div class="product-wishlist">
                                                <a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-title">
                                            <h6><a href="{{ url('product/' .Product::inRandomOrder()->first()->slug) }}">The Mathias Diamond Pendant</a></h6>
                                        </div>
                                        <div class="product-price">
                                            <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                                            <small>You Save</small>
                                            <span class="product-price-save">₹5,338 <span class="product-discount">[20% Off]</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
