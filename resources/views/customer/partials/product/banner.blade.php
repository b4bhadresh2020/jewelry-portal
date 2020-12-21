<style>
.breadcrumb-wrapper {
    background-image: url(@if(!empty($categoryOffer->bannerImage->first())) {!! @getMediaUrlToMedia($categoryOffer->bannerImage->first()->media->first()) !!} @else  {!! @getMediaUrlToMedia($categoryOffer->media) !!} @endif);
}
</style>
<div class="breadcrumb-wrapper">
    <div class="container">
    <div class="breadcrumb-title">@if(!empty($category))  {!! @$category->name !!} @else {!! @$subCategoryData->name !!} @endif</div>
    <div class="breadcrumb-ul">
        <ul>
        <li class="breadcrumb-nav"><a href="#">Home</a></li>
        <li class="breadcrumb-nav active"><a href="#">{!! $categoryOffer->name !!}</a></li>
        </ul>
    </div>
    </div>
</div>