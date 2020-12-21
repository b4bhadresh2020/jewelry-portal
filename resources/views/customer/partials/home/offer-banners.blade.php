<div class="benner-wrapper">
    <div class="container">
        <div class="row">
            @isset($offerFirst->status)
            @if(@$offerFirst->status==0)
            <div class="col-lg-12 benner-firstblock">
                <div class="benner-block">
                    <img src="{{asset('assets')}}/img/Banner-1.png">
                        <div class="benner-text">
                        <div class="benner-text-inner" style="background-image: url({{ asset('storage/'.@$offerFirst->offer_image) }});">
                            <h3>{{@$offerFirst->title}}</h3>
                            <h2>{{@$offerFirst->description}} </h2>
                            <a href="{{@$offerFirst->link_url}}">{{@$offerFirst->link_text}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endisset

            @isset($offerSecond->status)
            @if(@$offerSecond->status==0)
            <div class="col-lg-6 benner-secondblock">
                <div class="benner-block">
                    <img src="{{asset('assets')}}/img/Banner-2.png">
                    <div class="benner-text">
                        <div class="benner-text-inner" style="background-image: url({{ asset('storage/'.@$offerSecond->offer_image) }});">
                            <h3>{{@$offerSecond->title}}</h3>
                            <h2>{{@$offerSecond->description}} </h2>
                            <a href="{{@$offerFirst->link_url}}">{{@$offerFirst->link_text}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endisset

            @isset($offerThird->status)
            @if(@$offerThird->status==0)
            <div class="col-lg-6 benner-thirdblock">
                <div class="benner-block">
                    <img src="{{asset('assets')}}/img/Banner-3.png">
                    <div class="benner-text">
                        <div class="benner-text-inner" style="background-image: url({{ asset('storage/'.@$offerThird->offer_image) }});">
                            {{-- <h3>PEARL <br/> BRACELET</h3> --}}
                            <h3>{{@$offerThird->title}}</h3>
                            <h2>{{@$offerThird->description}} </h2>
                            <a href="{{@$offerFirst->link_url}}">{{@$offerFirst->link_text}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endisset
        </div>
    </div>
</div>

