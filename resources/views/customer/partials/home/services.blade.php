<div class="services-wrapper">
    <div class="services-top">
        <div class="services-inner">
        @foreach($services as $service)
            <div class="services-block services1">
                <div class="services-des">
                    <div class="services-img">
                        <img src="{!! @getMediaUrlToMedia($service->media) !!}">
                    </div>
                    <div class="services-text">
                        <h4>{!!$service->title!!}</h4>
                        <p>{!!$service->description!!}</p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
