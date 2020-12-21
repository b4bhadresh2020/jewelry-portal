<div class="subcategory-product">
    <div class="subcategory-title">
    <h3>SUBCATEGORIES</h3>
    </div>
    <div class="subcategory-product-inner">
    @foreach($subCategories as $subCategory)
        <div class="subcategory-product-block">
            <div class="subcategory-img">
            <a href="#">
                <img src="{!! @getMediaUrlToMedia($subCategory->media) !!}">
                <h6>{!! $subCategory->name !!}</h6>
            </a>
            </div>
        </div>
    @endforeach
    {{-- <div class="subcategory-product-block">
        <div class="subcategory-img">
        <a href="#">
            <img src="{{asset('assets')}}/img/subcategory2.png">
            <h6>ring</h6>
        </a>
        </div>
    </div>
    <div class="subcategory-product-block">
        <div class="subcategory-img">
        <a href="#">
            <img src="{{asset('assets')}}/img/subcategory3.png">
            <h6>Necklace</h6>
        </a>
        </div>
    </div>
    <div class="subcategory-product-block">
        <div class="subcategory-img">
        <a href="#">
            <img src="{{asset('assets')}}/img/subcategory4.png">
            <h6>Earrings</h6>
        </a>
        </div>
    </div>
    <div class="subcategory-product-block">
        <div class="subcategory-img">
        <a href="#">
            <img src="{{asset('assets')}}/img/subcategory5.png">
            <h6>Necklace</h6>
        </a>
        </div>
    </div>
    <div class="subcategory-product-block">
        <div class="subcategory-img">
        <a href="#">
            <img src="{{asset('assets')}}/img/subcategory6.png">
            <h6>Necklace</h6>
        </a>
        </div>
    </div> --}}
    </div>
</div>