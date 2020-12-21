@php
    use App\AppSetting;
@endphp
@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Home')

{{-- defind style page level --}}
@section('page-style')
    @livewireStyles
@endsection

{{-- defind content --}}
@section('content')
    {{-- Start Home Banner --}}
    @include('customer.partials.home.banners')

    {{-- Start Services --}}
    @if (in_array(AppSetting::HOME_PAGE_SERVICES, $visibleBlockList))
        @include('customer.partials.home.services')
    @endif

    {{-- Start Categories --}}
    @include('customer.partials.home.categories')

    {{-- Start Trending Products --}}
    @if (in_array(AppSetting::HOME_PAGE_TRENDING_PRODUCTS, $visibleBlockList))
        @include('customer.partials.home.trending-products')
    @endif

    {{-- Start Offer Banners --}}
    @if (in_array(AppSetting::HOME_PAGE_OFFERS, $visibleBlockList))
        @include('customer.partials.home.offer-banners')
    @endif

    {{-- Start New Collection --}}
    @if (in_array(AppSetting::HOME_OFFER_SLIDER_ONE, $visibleBlockList))
        @include('customer.partials.home.new-collection')
    @endif

    {{-- Start Best Sellers --}}
    @include('customer.partials.home.best-sellers')

    {{-- Start Signal Offer Banner --}}
    @if (in_array(AppSetting::HOME_PAGE_BACKGROUND_OFFER, $visibleBlockList))
        @include('customer.partials.home.signal-offer-banner')
    @endif

    {{-- Start Testimonial --}}
    @if (in_array(AppSetting::HOME_PAGE_TESTIMONIAL, $visibleBlockList))
        @include('customer.partials.home.testimonial')
    @endif

    {{-- Start Special Product --}}
    @if (in_array(AppSetting::HOME_OFFER_SLIDER_TWO, $visibleBlockList))
        @include('customer.partials.home.special-product')
    @endif

    {{-- Start Lettest Blogs --}}
    @if (in_array(AppSetting::HOME_PAGE_BLOGS, $visibleBlockList))
        @include('customer.partials.home.lettest-blogs')
    @endif

@endsection

{{-- defind script page level --}}
@section('page-script')
    @livewireScripts

    <script>
        $(document).ready(function() {

            //declare variable
            var blogOwl = $(".blog")
                testimonialOwl = $(".testimonial"),
                newCollectionOwl = $(".new-collection-product"),
                specialProductOwl = $(".special-product-carousel"),
                blogCurrentPage = 0,
                testimonialCurrentPage = 0,
                newCollectionCurrentPage = 0,
                specialProductCurrentPage = 0;

            //init blog carousel
            blogOwl.owlCarousel({
                margin:30,
                autoplay: true,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true
                    },
                    480:{
                        items:1,
                        nav:false
                    },
                    550:{
                        items:2,
                        nav:false
                    },
                    600:{
                        items:2,
                        nav:false
                    },
                    800:{
                        items:2,
                        nav:false
                    },
                    992:{
                        items:3,
                        nav:false
                    },
                    1000:{
                        items:3,
                        nav:true,
                        loop:true
                    }
                },
                onDragged : function (event) {
                    event.preventDefault();
                    bannerAjax('lettest-blogs');
                }
            });

            //init testimonial carousel
            testimonialOwl.owlCarousel({
                margin:30,
                autoplay: true,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true
                    },
                    576:{
                        items:2,
                        nav:false
                    },
                    991:{
                        items:2,
                        nav:false
                    },
                    992:{
                        items:3,
                        nav:false,
                        loop:true
                    },
                    1000:{
                        items:3,
                        nav:true,
                        loop:true
                    }
                },
                onDragged : function (event) {
                    event.preventDefault();
                    bannerAjax('testimonials');
                }
            });

            //init new-collection-product carousel
            newCollectionOwl.owlCarousel({
                margin:30,
                autoplay: true,
                responsiveClass:true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    480: {
                        items: 2,
                        nav: false
                    },
                    575: {
                        items: 2,
                        nav: false
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    768: {
                        items: 3,
                        nav: false
                    },
                    992: {
                        items: 3,
                        nav: false
                    },
                    1300: {
                        items: 3,
                        nav: true,
                        loop: true
                    }
                },
                onDragged : function (event) {
                    event.preventDefault();
                    bannerAjax('new-collection');
                }
            });

            //init special product carousel
            specialProductOwl.owlCarousel({
                margin:30,
                autoplay: true,
                responsiveClass:true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    480: {
                        items: 2,
                        nav: false
                    },
                    575: {
                        items: 2,
                        nav: false
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    768: {
                        items: 3,
                        nav: false
                    },
                    992: {
                        items: 3,
                        nav: false
                    },
                    1300: {
                        items: 3,
                        nav: true,
                        loop: true
                    }
                },
                onDragged : function (event) {
                    event.preventDefault();
                    bannerAjax('special-product');
                }
            });

            // first time call when  page load
            @if (in_array(AppSetting::HOME_OFFER_SLIDER_ONE, $visibleBlockList))
                bannerAjax('new-collection');
            @endif

            @if (in_array(AppSetting::HOME_PAGE_TESTIMONIAL, $visibleBlockList))
                bannerAjax('testimonials');
            @endif

            @if (in_array(AppSetting::HOME_OFFER_SLIDER_TWO, $visibleBlockList))
                bannerAjax('special-product');
            @endif

            @if (in_array(AppSetting::HOME_PAGE_BLOGS, $visibleBlockList))
                bannerAjax('lettest-blogs');
            @endif


            $('.blog-wrapper .btn-next').click(function (e) {
                bannerAjax('lettest-blogs');
            });
            $('.testimonial-wrapper .btn-next').click(function (e) {
                bannerAjax('testimonials');
            });
            $('.new-collection-product-wrapper .btn-next').click(function (e) {
                bannerAjax('new-collection');
            });
            $('.special-product-wrapper .btn-next').click(function (e) {
                bannerAjax('special-product');
            });

            function bannerAjax($type){
                var param;
                switch($type)
                {
                    case 'lettest-blogs':
                        blogCurrentPage++;
                        param = {page: blogCurrentPage};
                    break;

                    case 'testimonials':
                        testimonialCurrentPage++;
                        param = {page: testimonialCurrentPage};
                    break;

                    case 'new-collection':
                        newCollectionCurrentPage++;
                        param = {page: newCollectionCurrentPage};
                    break;

                    case 'special-product':
                        specialProductCurrentPage++;
                        param = {page: specialProductCurrentPage};
                    break;
                }

                $.ajax({
                    url: BASEURL + '/home/'+$type+'/banner',
                    type: 'GET',
                    dataType: 'json',
                    data: param,
                })
                .done(function(res) {
                    if(res.length)
                    {
                        switch($type)
                        {
                            case 'lettest-blogs':
                                $.each(res, function(index, value){
                                    blogOwl.trigger('add.owl.carousel',[jQuery(value)]).trigger('refresh.owl.carousel');
                                });
                            break;

                            case 'testimonials':
                                $.each(res, function(index, value){
                                    testimonialOwl.trigger('add.owl.carousel',[jQuery(value)]).trigger('refresh.owl.carousel');
                                });
                            break;

                            case 'new-collection':
                                $.each(res, function(index, value){
                                    newCollectionOwl.trigger('add.owl.carousel',[jQuery(value)]).trigger('refresh.owl.carousel');
                                });
                            break;

                            case 'special-product':
                                $.each(res, function(index, value){
                                    specialProductOwl.trigger('add.owl.carousel',[jQuery(value)]).trigger('refresh.owl.carousel');
                                });
                            break;
                        }
                    }else{
                        switch($type)
                        {
                            case 'lettest-blogs':
                                if(blogCurrentPage === 1 && res.length !== 3){
                                    $(".blog-wrapper").remove();
                                }
                            break;

                            case 'testimonials':
                                if(testimonialCurrentPage === 1 && res.length !== 3){
                                    $(".testimonial-wrapper").remove();
                                }
                            break;

                            case 'new-collection':
                                if(newCollectionCurrentPage === 1 && res.length !== 3){
                                    $(".new-collection-product-wrapper").remove();
                                }
                            break;

                            case 'special-product':
                                if(specialProductCurrentPage === 1 && res.length !== 3){
                                    $(".special-product-wrapper").remove();
                                }
                            break;
                        }
                    }
                });
            }
        });
    </script>
@endsection

