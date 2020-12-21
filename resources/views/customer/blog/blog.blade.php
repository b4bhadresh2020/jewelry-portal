@extends('customer.layouts.layoutMaster')

@section('page-style')
@endsection

@section('content')
    @include('customer.blog.banner')
    <div class="all-blog-wrapper">
        <div class="container">
            @if (count($blogs) != 0)
                <div class="row">
                    @foreach($blogs as $blog)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="all-blog-inner">
                                <div class="all-blog-img">
                                <img src="{{url('storage/'.$blog->image)}}">
                                </div>
                                <div class="all-blog-text">
                                <div class="all-blog-text-title">
                                    <a href="{{url('single-blog-view/'.$blog->id)}}"><h2>{{$blog->title}}</h2></a>
                                </div>
                                <div class="all-blog-text-archive-meta">
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
                                <p>{{(strlen($blog->short_description) > 100) ? substr($blog->short_description, 0, 100) . "..." : $blog->short_description  }}</p>
                                <a class="all-blog-continue" href="{{url('single-blog-view/'.$blog->id)}}">Continue</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="all-blog-pagination">
                    <div class="all-blog-pagination-text">
                        <h6>
                            {!! $blogs->currentPage()."-".$blogs->lastPage()." of ".$blogs->total() !!}
                        </h6>
                    </div>
                    {!! $blogs->appends(request()->input())->links('customer.blog.pagination') !!}
                </div>
            @else
                <main id="main" class="site-main mb-5 pb-5" role="main">
			        <section class="data-not-found not-found">
				        <header class="page-header">
					        <h1 class="page-title">404</h1>
				        </header>
				        <div class="page-content">
                            <h5>We are sorry. you are looking page data can not found.</h5>
                            <a class="btn btn-info mt-2" href="{{ url('/') }}">Back To Home</a>
				        </div>
			        </section>
                </main>
            @endif
        </div>
    </div>
@endsection
