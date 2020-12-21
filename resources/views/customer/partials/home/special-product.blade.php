<div class="product-wrapper special-product">
    <div class="container">
        <div class="title-pagin-block">
            <div class="title-wrapper">
                <div class="title-inner">
                    <h2>Special Product</h2>
                </div>
            </div>
            <div class='pagin'>
                <button class='pagin-btn btn-prev'><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                <button class='pagin-btn btn-next'><i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="product-inner">
            @isset($offersix->status)
                @if(@$offersix->status==0)
                    <div class="product-img left">
                        <img src="{{ asset('storage/'.@$offersix->offer_image) }}">
                    </div>
                @endif
            @endisset
            <div class="product-block">
                <div class="special-product-carousel product owl-carousel"></div>
            </div>
        </div>
    </div>
</div>
