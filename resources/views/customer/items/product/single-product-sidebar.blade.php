<div class="multiproduct owl-carousel">
    @foreach ($productAttribute->images as $productImage)
        <div class='item'>
            <div class="multiproduct-inner">
                <div class="multiproduct_img">
                    <a href="javascript:;"><img src="{{ getMediaUrlToMedia($productImage->media[0]) }}"></a>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class='multiproduct-btn'>
    <button class='pagin-btn btn-prev'><i class="fa fa-angle-left" aria-hidden="true"></i></button>
    <button class='pagin-btn btn-next'><i class="fa fa-angle-right" aria-hidden="true"></i></button>
</div>

