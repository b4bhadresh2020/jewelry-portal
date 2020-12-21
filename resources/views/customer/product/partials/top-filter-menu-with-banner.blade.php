<form id="sub-category-filter-form">
    @isset($selectedCategory)
        @if ($selectedCategory->offer_banner_visibility == 1)
            <div class="category-cover">
                <img src="{{ @getMediaUrlToMedia($selectedCategory->offerImage->first()->media->first()) }}">
                <h2>{!! $selectedCategory->name !!}</h2>
                <p>{!! $selectedCategory->description !!}</p>
            </div>
        @endif
    @endisset

    @isset($selectedCategory->subCategory)
        <div class="subcategory-product">
            <div class="subcategory-title">
                <h3>SUBCATEGORIES</h3>
            </div>
            <div class="subcategory-product-inner">
                @foreach ($selectedCategory->subCategory as $subCategorie)
                    <div class="subcategory-product-block">
                        <div class="subcategory-img @if($subCategorie->id == ($selectedSubCategory->id ?? 0)) active @endif" onclick="findProductBySubcategory(this)">
                            <input
                                type="radio"
                                name="sub_category_id"
                                id="subcategory{{ $subCategorie->id }}"
                                value="{{ $subCategorie->id }}"
                                @if($subCategorie->id == ($selectedSubCategory->id ?? 0)) checked @endif>
                            <a href="javascript:;">
                                <img src="{{ getMediaUrlToMedia($subCategorie->media) }}">
                                <h6>{{ $subCategorie->{'name:'.$locale} }}</h6>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <br>
    @endisset
</form>
