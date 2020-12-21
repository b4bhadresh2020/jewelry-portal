<div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
    <div class="review-block">
        {{-- Display Reviews --}}
        @isset($defaultAttribute->review[0])
            <div class="review-post">
                <table class="table table-striped table-bordered">
                    <tbody id="#table_data">
                        @isset($defaultAttribute->review)
                            @foreach($defaultAttribute->review as $review)
                                <tr>
                                    <td class="review-post-type" colspan="2">
                                        <h4>{{ $review->users->first_name }}<p class="review-date text-right">{{ date('d-M-Y',strtotime($review->created_at)) }}</p></h4>
                                        <p>{{$review->review}}</p>
                                        <div class="review-post-rating">
                                            @for($i=1; $i<=5; $i++)
                                                @if($review->rating>=$i)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning alert-dismissible fade show mt-3">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>No review</strong>
            </div>
        @endisset

        {{-- Create Reviews --}}
        @if (Auth::check())
            <form class="form-horizontal" id="review-rating">
                @csrf
                <div class="review-write-block">
                    <h3>Write a review</h3>
                    <input  type="hidden" name="attribute_id" id="attribute_id" value="{{ $defaultAttribute->id }}"/>
                    <input  type="hidden" name="user_id"  value="@auth{{Auth::user()->id }}@endauth"/>

                    <div class="form-group required">
                        <label class="control-label" for="input-name">Your Name</label>
                        <input type="text" name="username" readonly value="@auth {{ @Auth::user()->first_name }} {{ \Auth::user()->last_name }} @endauth" id="input-name"
                            class="form-control">
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="input-review">Your Review</label>
                        <textarea  name="review" rows="5" id="input-review" class="form-control"
                            spellcheck="false"></textarea>
                    </div>
                    <div class="form-group required control-label">
                        <label class="control-label" for="input-name">Rating</label>
                        {{-- <div class="form-rating">
                            <div class="form-rating-inner">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                        </div> --}}
                        <div class="rating">
                            <input type="radio" name="rating" value="5" id="5">
                            <label for="5">☆</label>
                            <input type="radio" name="rating" value="4" id="4">
                            <label for="4">☆</label>
                            <input type="radio" name="rating" value="3" id="3">
                            <label for="3">☆</label>
                            <input type="radio" name="rating" value="2" id="2">
                            <label for="2">☆</label>
                            <input type="radio" name="rating" value="1" id="1">
                            <label for="1">☆</label>
                        </div>
                    </div>
                    <div class="form-button">
                        <button id="button-review" type="button"
                            class="btn btn-primary">Continue</button>
                    </div>
                </div>
                <div class="review-write-block-message">
                    <div class="alert alert-danger alert-dismissible fade show mt-3">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Your are not add review</strong>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
