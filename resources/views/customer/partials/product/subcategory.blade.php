<div class="subcategory-product">
    <div class="subcategory-title">
    <h3>SUBCATEGORIES</h3>
    </div>
    <div class="subcategory-product-inner">
    @foreach($subCategories as $subCategory)
        <div class="subcategory-product-block">
            <div class="subcategory-img" @if(empty($category))@if($subCategory->name == $subCategoryData->name) style="border: 1px dashed #eccd4f;" @endif @endif>
            <a  id="subcategory-{{$subCategory->id}}"  onclick="findProductBySubcategory({{$subCategory->id}})">
                <img src="{!! @getMediaUrlToMedia($subCategory->media) !!}">
                <h6>{!! $subCategory->name !!}</h6>
            </a>
            </div>
        </div>
    @endforeach
    </div>
</div>