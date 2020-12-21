<div class='item'>
    <div class="product-wrapper-content">
        <div class="product-image">
            <a href="#" class="product-thumbnail">
                <img src="{{ $product->image }}">
                <img class="product-image-hover" src="{{ $product->hover_image }}">
            </a>
            <div class="product-icon">
                <div class="product-wishlist">
                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="product-description">
            <div class="product-title">
                <h6><a href="#">{{ $product->title }}</a></h6>
            </div>
            <div class="product-price">
                <span class="product-price">₹{{ $product->sell_price }} <span class="product-regular-price"><del>₹{{ $product->price }}</del></span></span>
                <small>You Save</small>
                <span class="product-price-save">₹{{ $product->save_price }} <span class="product-discount">[{{ $product->offer_per }}% Off]</span></span>
            </div>
        </div>
    </div>
</div>            