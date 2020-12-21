@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Home')

{{-- defind style page level --}}
@section('page-style')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
<style>
    .color-block input,
    .subcategory-product-block input{
        display: none;
    }
    .subcategory-img.active{
        border: 1px dashed rgb(236, 205, 79);
    }

    .price-range-block {
        margin:60px;
    }
    .range-fields{
        display: flow-root;
        margin-bottom: 15px;
    }
    .sliderText{
        width:40%;
        margin-bottom:30px;
        border-bottom: 2px solid black;
        padding: 10px 0 10px 0px;
        font-weight:bold;
    }

    .ui-slider-horizontal {
        height: .6em;
    }
    .ui-slider-horizontal {
        margin-bottom: 15px;
        width:100%;
    }
    .ui-widget-header {
        background: #fcde02;
    }

    .price-range-search {
        width:40.5%;
        min-width: 40%;
        display: inline-block;
        height: 32px;
        border-radius: 5px;
        margin-bottom:20px;
        font-size:16px;
    }
    .price-range-field,
    .price-range-field:hover,
    .price-range-field:focus{
        background-color:#f9f9f9;
        border: 1px solid #6e6666;
        color: black;
        font-family: myFont;
        font: normal 14px Arial, Helvetica, sans-serif;
        border-radius: 5px;
        height:26px;
        padding:5px;
        background: transparent;
        border-radius: 0px !important;
        outline: none !important;
        box-shadow: none !important;
    }
</style>
<script>
    var min_price_filter = parseInt("{{ MIN_PRICE_FILTER }}");
    var max_price_filter = parseInt("{{ MAX_PRICE_FILTER }}");
    var productNotFound = '<div class="col-md-12">'+
                                '<div class="alert alert-danger" role="alert">'+
                                    '<h4 class="alert-heading">Sorry!</h4>'+
                                    '<p>This type of filtering product not available in your system.</p>'+
                                    '<hr>'+
                                    '<p class="mb-0">for more information please contact </p>'+
                                '</div>'+
                            '</div>';
</script>
@endsection

{{-- defind content --}}
@section('content')

    {{-- Load Product Breadcrumb --}}
    @include('customer.product.partials.main-product-breadcrumb')

    <div class="categorypage-wrapper">
        <div class="categorypage-inner" id="categorypage-inner">
            <div class="container">
                <div class="row">

                    {{-- Load Prodcut filter Panel Ex: Color Wise, Price Wise --}}
                    @include('customer.product.partials.filter-panel')

                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="content-wrapper">

                            {{-- Load Sub-Category filter Panel & Banner --}}
                            @include('customer.product.partials.top-filter-menu-with-banner')

                            <div class="grid-list-wrapper">

                                {{-- Product Design Filter & Sort Option --}}
                                <div class="grid-list-inner">
                                    <div class="grid-list-block">
                                        <div class="grid-list-tab">
                                            <div class="tab">
                                                <button data-layout-style="grid" class="tablinks grid grid-list-button" onclick="openCity(event, 'grid')">
                                                    <i class="fa fa-th-large" aria-hidden="true"></i>
                                                </button>
                                                <button data-layout-style="list" class="tablinks list grid-list-button" onclick="openCity(event, 'list')">
                                                    <i class="fa fa-th-list" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div class="tab-total-product">
                                                <p>There are <span class="totalProducts">{{ $totalProducts }}</span> products.</p>
                                            </div>
                                        </div>
                                        <div class="grid-list-dropdown product-sort-box">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"></button>
                                                <div class="dropdown-menu">
                                                    @foreach ($productSortOptions as $sortKey => $sortName)
                                                        <a data-key="{{ $sortKey }}" class="dropdown-item" href="javascript:;">{{ $sortName }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Load Grid Design --}}
                                <div id="grid" class="tabcontent">
                                    <div class="grid-wrapper">
                                        <div class="row">
                                            {!! $productContent !!}
                                        </div>
                                    </div>
                                </div>

                                {{-- Load List Design --}}
                                <div id="list" class="tabcontent">
                                    <div class="list-wrapper">
                                        <div class="row">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- defind script page level --}}
@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<script>

    var moreProduct = true,
        productLayoutStyle = 'grid',
        productSortBy = 0,
        page = 1,
        loadMore = true,
        filterOptions = [],
        subCategoryFilter = [],
        productSortOptions = @json($productSortOptions);

    $(document).ready(function() {

        @if(!$productContent)
            $("#grid .row").html(productNotFound);
        @endif

        @if($selectedCategory)
            filterOptions = $("#sidebar-filter-form").serializeArray();
            subCategoryFilter = $("#sub-category-filter-form").serializeArray();
        @endif

        // Set Default Sort Name
        $('.product-sort-box button').html(productSortOptions[productSortBy]);

        // Click Color Icon
        $(".color-block").click(function(){
            if($(this).hasClass('active')){
                $(this).removeClass('active');
                $(this).find('input').prop('checked', false);
            }else{
                $(this).addClass('active');
                $(this).find('input').prop('checked', true);
            }
            applyFilter();
        });

        // Change Product layout | For Ex :  Grid, List etc...
        $(".grid-list-tab button").click(function(){
            productLayoutStyle = $(this).attr('data-layout-style');
            page = 1;
            loadProduct();
        });

        // Change Product Sort | For Ex :  A - Z, Z- A, Low To High etc..
        $(".product-sort-box .dropdown-item").click(function(){
            $('.product-sort-box button').html($(this).html());
            productSortBy = $(this).attr('data-key');
            page = 1;
            loadProduct();
        });

        // Price Filter Start
        $('#price-range-submit').hide();
        $("#min_price,#max_price").on('change', function () {
            $('#price-range-submit').show();
            var min_price_range = parseInt($("#min_price").val());
            var max_price_range = parseInt($("#max_price").val());
            if (min_price_range > max_price_range) {
                $('#max_price').val(min_price_range);
            }
            $("#slider-range").slider({
                values: [min_price_range, max_price_range]
            });
        });


        // $("#min_price,#max_price").on("paste keyup", function () {
        //     $('#price-range-submit').show();
        //     var min_price_range = parseInt($("#min_price").val());
        //     var max_price_range = parseInt($("#max_price").val());
        //     if(min_price_range == max_price_range){
        //         max_price_range = min_price_range + 100;
        //         $("#min_price").val(min_price_range);
        //         $("#max_price").val(max_price_range);
        //     }
        //     $("#slider-range").slider({
        //         values: [min_price_range, max_price_range]
        //     });
        // });

        $(function () {
            $("#slider-range").slider({
                range: true,
                orientation: "horizontal",
                min: min_price_filter,
                max: max_price_filter,
                values: [min_price_filter, max_price_filter],
                step: 100,
                slide: function (event, ui) {
                    if (ui.values[0] == ui.values[1])  return false;
                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);
                }
            });

            $("#min_price").val($("#slider-range").slider("values", 0));
            $("#max_price").val($("#slider-range").slider("values", 1));
        });

        $("#slider-range,#price-range-submit").click(function () {
            page = 1;
            applyFilter();
        });
        // Price Filter End
    });

    // When Customer Scroll Down Load More Product With Same Filter Options
    $(window).scroll(function() {
        if($(window).scrollTop() >= $(document).height()  -( $(window).height() * 2 )) {
            page++;
            loadProduct();
        }
    });

    // When Customer Filter Any Options Like Color Wise etc..
    function applyFilter(){
        filterOptions = $("#sidebar-filter-form").serializeArray();
        page = 1;
        loadProduct();
    }

    // When Customer Click On Clear Filter Option
    function clearFilter(){
        $("#sidebar-filter-form").trigger('reset');
        $("#sub-category-filter-form").trigger('reset');
        $(".color-block").removeClass('active')
        $(".color-block").find('input').prop('checked', false);
        $(".subcategory-img").removeClass('active');
        $("#min_price").val(min_price_filter).change();
        $("#max_price").val(max_price_filter).change();
        page = 1;
        filterOptions = subCategoryFilter = [];
        applyFilter();
        // $('html, body').animate({
        //     scrollTop: $("#categorypage-inner").offset().top
        // }, 500);
    }

    // When Customer Click On Sub Category Option
    function findProductBySubcategory(el)
    {
        $(el).find('input').prop('checked', true);
        subCategoryFilter = $("#sub-category-filter-form").serializeArray();
        $('.subcategory-img').removeClass('active');
        $(el).addClass('active');
        page = 1;
        loadProduct();
    }

    // Call Ajex
    function loadProduct(){
        var filterUrl = '{{ __url("products-filter") }}/' + page;
        var finalFilter = filterOptions.concat(subCategoryFilter).concat([
            {
                'name' : 'productSortBy',
                'value' : productSortBy
            },{
                'name' : 'productLayoutStyle',
                'value' : productLayoutStyle
            }
        ]);

        $.getJSON(filterUrl, finalFilter, function(json, textStatus) {
            $(".totalProducts").html(json.totalProducts);
            if(json.data){
                if(productLayoutStyle =="grid"){
                    (page == 1) ? $("#grid .row").html(json.data) : $("#grid .row").append(json.data);
                }else if(productLayoutStyle =="list"){
                    (page == 1) ? $("#list .row").html(json.data) : $("#list .row").append(json.data);
                }

                if (typeof lazyload == 'function'){
                    $("img.lazyload").lazyload();
                }
            }else{
                if(page == 1){
                    $("#list .row").html(productNotFound);
                    $("#grid .row").html(productNotFound);
                }
            }
        });
    }

    /*
        // if (history.pushState) {
        //     window.history.pushState(null, '',window.location.pathname);
        // }

        // var newurlPath = window.location.pathname +"?" + queryString;
        // if (history.pushState) {
        //     window.history.pushState(null, '',newurlPath);
        // }
    */
</script>
@endsection

