@if(!$sellers->isEmpty())
    <div class="best-sellers-wrapper">
        <div class="container">
            <div class="title-pagin-block">
                <div class="title-wrapper">
                    <div class="title-inner">
                        <h2>HIGHLIGHT DESIGN</h2>
                    </div>
                </div>
                <div class='pagin'>
                    <button class='pagin-btn btn-prev'><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                    <button class='pagin-btn btn-next'><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="best-sellers-inner">
                <div class="bestsellers owl-carousel">
                    @foreach($sellers as $seller)
                        <div class='item'>
                            <div class="bestsellers-inner">
                                <div class="bestsellers_img"><img src="{{ @getMediaUrlToMedia($seller->media) }}"></div>
                                <div class="bestsellers-text">
                                    <h5>{{$seller->title}}</h5>
                                    <p>{{$seller->subtitle}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
