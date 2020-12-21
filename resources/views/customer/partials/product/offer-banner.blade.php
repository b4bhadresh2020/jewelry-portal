@if($categoryOffer->offer_banner_visibility == 1)
<div class="category-cover">
    <img src="{!! @getMediaUrlToMedia($categoryOffer->offerImage->first()->media->first()) !!}">
    <h2>{!! $categoryOffer->name !!}</h2>
    <p>{!! $categoryOffer->description !!}</p>
</div>
@endif