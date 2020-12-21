<div class="category-cover">
    <img src="{!! @getMediaUrlToMedia($categoryOffer->offerImage->first()->media->first()) !!}">
    <h2>{!! $categoryOffer->name !!}</h2>
    <p>{!! $categoryOffer->description !!}</p>
</div>