<div class="new-collection-product-wrapper product-wrapper new-product">
    <div class="container">
        <div class="title-pagin-block">
            <div class="title-wrapper">
                <div class="title-inner">
                    <h2>Our New Of Collection</h2>
                </div>
            </div>
            <div class='pagin'>
                <button class='pagin-btn btn-prev'><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                <button class='pagin-btn btn-next'><i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="product-inner">
            @isset($offerfive->status)
                @if(@$offerfive->status==0)
                    <div class="product-img left">
                        <img src="{{ asset('storage/'.@$offerfive->offer_image) }}">
                    </div>
                @endif
            @endisset
            <div class="product-block">
                <div class="new-collection-product product owl-carousel"></div>
            </div>
        </div>
    </div>
</div>
