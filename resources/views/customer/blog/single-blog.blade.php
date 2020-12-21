@extends('customer.layouts.layoutMaster')

@section('content')
    @include('customer.blog.banner')

    <div class="single-blog-wrapper">
        <div class="container">
          <div class="single-blog-inner">
            <div class="single-blog-text-block-inner">
              <div class="single-blog-img">
                <img src="{{url('storage/'.$blog->image)}}">
              </div>
              <div class="single-blog-text-block">
                <h2>{{$blog->title}}</h2>
                <div class="single-blog-archive">
                    <div class="archive-author">
                      <span>By Shivaay Jewellers</span>
                    </div>
                    <div class="archive-date">
                      <span>{{date('d-M-Y',strtotime($blog->created_at))}}</span>
                    </div>
                    {{-- <div class="archive-comment">
                      <span>Views (0)</span>
                    </div> --}}
                </div>
                <p>{!!$blog->short_description!!}</p>
                <p>{!!$blog->long_description!!}</p>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
