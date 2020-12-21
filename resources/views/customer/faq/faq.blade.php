<div class="faq-wrapper">
    <div class="container">
        <div id="accordion">
            @foreach ($faqCategories as $categories)
                <div class="card">
                    <h4 class="faq-category">{{$categories->name}}</h4>
                    @foreach ($categories->faq as $faq)
                        <div class="card-header" id="faq-{{$categories->id}}">
                            <button class="btn btn-link accordion-title collapsed" data-toggle="collapse" data-target="#collapse-{{$faq->id}}" aria-expanded="false" aria-controls="#collapse-{{$faq->id}}">
                                <span>{{$faq->question}}</span>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div id="collapse-{{$faq->id}}" class="collapse " aria-labelledby="faq-{{$faq->id}}" data-parent="#accordion">
                            <div class="card-body accordion-body">
                                <p>{!!$faq->answer!!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
