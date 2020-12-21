@if ($relatedProducts)
    <div class="product-related">
        <div class="product-wrapper related-product">
            <div class="container">
                <div class="title-pagin-block">
                    <div class="title-wrapper">
                        <div class="title-inner">
                            <h2>You Might Also Like</h2>
                        </div>
                    </div>
                    <div class='pagin'>
                        <button class='pagin-btn btn-prev'><i class="fa fa-angle-left"
                                aria-hidden="true"></i></button>
                        <button class='pagin-btn btn-next'><i class="fa fa-angle-right"
                                aria-hidden="true"></i></button>
                    </div>
                </div>
                <div class="product-inner">
                    <div class="product-block">
                        <div class="related owl-carousel">
                            @foreach ($relatedProducts as $productAttribute)
                                @include('customer.items.product.related-product-item', [
                                    'productAttribute' => $productAttribute
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
