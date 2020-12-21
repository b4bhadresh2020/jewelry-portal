<div class="carousel-item @if($key==0) active @endif">
    @if($banner->banner!=null)
        <img src="{{ url('storage/'.$banner->banner) }}">
    @else
        <img src="{{url('default/not-found.png')}}">
    @endif
    <div class="carousel-caption">
        @if(!empty($banner->header))
            <p>{{$banner->header}}</p>
        @endif
        @if(!empty($banner->title))
            <h2>{{$banner->title}}</h2>
        @endif
        @if(!empty($banner->description))
            <p>{{$banner->description}}</p>
        @endif
        @if ($banner->link_url != "")
            <a href="{{$banner->link_url}}">{{ $banner->link_text ? $banner->link_text : "Buy Now" }}</a>
        @endif
    </div>
</div>
