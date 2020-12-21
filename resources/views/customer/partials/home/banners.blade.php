@if(!$banners->isEmpty())
    <div class="mobile-slider-wrapper slider-wrapper">
        <div id="mobile-slider" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#mobile-slider" data-slide-to="0" class="active"></li>
                <li data-target="#mobile-slider" data-slide-to="1"></li>
                <li data-target="#mobile-slider" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                    @include('customer.items.home.banner')
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#mobile-slider" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#mobile-slider" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <div class="slider-wrapper desktop-slider">
        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                    @include('customer.items.home.banner')
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
@endif
