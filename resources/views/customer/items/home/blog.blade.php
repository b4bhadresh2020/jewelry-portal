
<div class='item'>
    <div class="blog-block">
        <div class="blog-img">
            <img style="height: 350px" src="{{asset('storage/'.$blog->image)}}">
            <div class="blog-date">
                <div class="blog-date-inner">
                    <span>{{ date('d', strtotime($blog->created_at)) }}</span>{{ date('M', strtotime($blog->created_at)) }}
                </div>
            </div>
        </div>
        <div class="blog-text">
            <div class="blog-title">
            <a href="{{url('single-blog-view/'.$blog->id)}}">{{ $blog->title}}</a>
            </div>
            <div class="blog-des">
                <p>{{(strlen($blog->short_description) > 100) ? substr($blog->short_description, 0, 100) . "..." : $blog->short_description  }}</p>
            </div>
            <div class="blog-button">
                <a href="{{url('single-blog-view/'.$blog->id)}}">Read More</a>
            </div>
        </div>
    </div>
</div>
