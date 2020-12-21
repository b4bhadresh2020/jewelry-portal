@isset($offerFour->status)
@if(@$offerFour->status==0)
<div class="signal-wrapper">
    <div class="container">
        <div class="signal-block">
            <h5>{{@$offerFour->header }}</h5>
            <h2>{{@$offerFour->title }}</h2>
            <p>{{@$offerFour->description}}</p>
            <div class="signal-block-button"><a href="{{@$offerFour->link_url}}">{{@$offerFour->link_text}}</a></div>
        </div>
    </div>
</div>
@endif
@endisset

