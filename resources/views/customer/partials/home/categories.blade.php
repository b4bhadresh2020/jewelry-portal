<div class="category-wrapper">
    <div class="container">
        <div class="title-pagin-block">
            <div class="title-wrapper">
                <div class="title-inner">
                    <h2>SHOP BY CATEGORY</h2>
                </div>
            </div>
            <div class='pagin'>
                <button class='pagin-btn btn-prev'><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                <button class='pagin-btn btn-next'><i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="category-top-inner">
            <div class="category owl-carousel">

                @foreach ($categories as $category)
                <div class='item'>
                    <div class="category-inner">
                    <a href="@if(!empty(@$category->slug)){{url('adimin/'.@$category->slug)}} @else #@endif">
                        <div class="category_img"><img src="{{ @getMediaUrlToMedia($category->media) }}"></div>
                        <div class="category-text">
                            @if($category->name!=null)
                            <h5>{{ @$category->name }}</h5>
                            @endif
                        </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
