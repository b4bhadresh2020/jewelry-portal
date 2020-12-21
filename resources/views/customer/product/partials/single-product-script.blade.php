<script>

    /********************************************************************************************************
    Global | Global | Global | Global | Global | Global | Global | Global | Global | Global | Global | Global
    *********************************************************************************************************/

    $( document ).ready(function() {
        /** Review Write block hide **/
        $('.review-write-block-message').hide();

        /** Engraving block hide **/
        $('.productpage-engraving').hide();
    });

    /********************************************************************************************************
    Filter | Filter | Filter | Filter | Filter | Filter | Filter | Filter | Filter | Filter | Filter | Filter
    *********************************************************************************************************/

    /** this function call every time when user change product variation */
    function filterOtherProductVariation(el){
        updateDataSheet(el);
        filterProductVariationWise();
    }

    function filterDiamondQualityWise(el){
        // maintain active class & hidden state & updateDataSheet
        $("#diamondQuality").val($(el).attr('data-id'));
        $('.diamond-quantity-block').removeClass('active');
        $(el).parents('.diamond-quantity-block').addClass('active');
        $("#data-sheet-item-val" + $(el).attr('attribute-id')).html($(el).find('span').html());
        // filter
        filterProductVariationWise();
    }

    function filterProductVariationWise(){
        $(".not-available-product-msg").hide();
        var formdata = $("#form-product-filter-variation").serializeArray()
        $.getJSON('{{ __url("product-variation") }}', formdata, function(json, textStatus) {
            if(json.status){
                $('#attribute_id').val(json.data.id);
                $('.product_attribute_id').val(json.data.id);
                $('.review-write-block').show();
                $('.review-write-block-message').hide();
                var productAttribute = json.data;
                reloadSidebar(productAttribute);
                stockMaintain(productAttribute)

                //Change Price & Sell Price
                $(".productpage-price .price").html(productAttribute.product_price.sell_price);
                $(".productpage-price .old-price").html(productAttribute.product_price.mrp);
            }else{
                $('.review-write-block').hide();
                $('.review-write-block-message').show();
                stockNotAvailable();
            }
        });
    }

    /** this function is used when stock is not available */
    function stockNotAvailable(){
        $(".not-available-product-msg").show();
        $("input[name=make_to_order]").val(0);
        $(".productpage-stock").hide();
        $('.addToCart').addClass("cart-btn-disabled");
    }

    /** this function is used to maintain stock */
    function stockMaintain(productAttribute){
        $(".not-available-product-msg").hide();
        $(".productpage-stock").show();
        $('.addToCart').removeClass("cart-btn-disabled");

        if(productAttribute.stock > 0){
            $(".in-stock-label").show();
            $('.make-to-order-label').hide();
            $("input[name=make_to_order]").val(0);
        }else{
            $(".in-stock-label").hide();
            $(".make-to-order-label").show();
            $("input[name=make_to_order]").val(1);
        }
    }

    /** this function is used to update data-sheet */
    function updateDataSheet(el){
        var dataId = $(el).attr('data-id');
        var dataType = $(el).attr("data-type");
        if(dataType=="select"){
            var val = $("#attribute"+dataId+" option:selected").text();
            $("#data-sheet-item-val"+dataId).html(val)
        }
    }

    /** this function is called when product attribute found in selected variation and update images & other images */
    function reloadSidebar(productAttribute){
        $(".default-img").attr('src',productAttribute.default_image_path);
        $(".multiproduct").owlCarousel('destroy');
        $(".LoadOwlCarousel").html(productAttribute.owlCarouselData);
        $('.multiproduct').owlCarousel({
            autoplay:false,
            autoplayTimeout:1000,
            autoplayHoverPause:false,
            loop:true,
            margin:10,
            responsiveClass:true,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                480:{
                    items:3,
                    nav:false
                },
                600:{
                    items:4,
                    nav:false
                },
                991:{
                    items:5,
                    nav:false
                },
                992:{
                    items:4,
                    nav:false
                },
                1000:{
                    items:4,
                    nav:true,
                    loop:true
                }
            }
        });
        $(document).on('click', '.multiproduct-btn .btn-prev', function(){
            $('.multiproduct .owl-nav .owl-prev').trigger('click');
        });
        $(document).on('click', '.multiproduct-btn .btn-next', function(){
            $('.multiproduct .owl-nav .owl-next').trigger('click');
        });
        $('.multiproduct .multiproduct_img a').click(function(){
            var srcVal = $(this).find('img').attr('src');
            $('.product-page-left-signal img').attr('src', srcVal);
        });
    }

    /********************************************************************************************************
    Engraving | Engraving | Engraving | Engraving | Engraving | Engraving | Engraving | Engraving | Engraving
    *********************************************************************************************************/

    /** Engraving is check block hide or stock **/
    $('#engraving').click(function() {
        if($(this).is(":checked")){
            $('.productpage-engraving').show();
        }else{
            $('.productpage-engraving').hide();
        }
    });

    /** Engraving name-box and font-box decrease click quantity decrement **/
    $(".productpage-quantity-decrease").click(function(){
        var quantity = $('input[name=quantity]').val();
        var qty = parseInt(quantity)+1;
        $( "#engraving" + qty).remove();
    });

    /** Engraving name-box and font-box increase click quantity increment **/
    $(".productpage-quantity-increase").click(function(){
        var quantity = $('input[name=quantity]').val();
        $("#all-engraving").append('<div class="engraving-box" id="engraving'+quantity+'">'
            +'<input type="text" class="form-control engraving-form" placeholder="Enter engraving name" name="engraving_name[]" id="engraving-name'+quantity+'">'
            +'<select name="engraving_font[]" class="form-control engraving-form" onchange="fontStyle(this.value,'+quantity+')" id="engraving-font'+quantity+'">'
            +'<option value="Nunito Sans">Select Font</option>'
            +'@foreach($fonts as $font)'
            +'<option value="{{$font}}">{{$font}}</option>'
            +' @endforeach'
            +'</select>'
        +'</div>');
    });

    /** Engraving name-box apply font style **/
    function fontStyle(font, qty){
        $('#engraving-name' + qty).css("font-family", font);
    }

    /** Engraving first name-box and font-box value apply all box **/
    $('#apply_all').click(function(){
        var quantity = $('input[name=quantity]').val();
        if($(this).is(":checked")){
            for(var i=2; i <= quantity; i++) {
                $('#engraving-name' + i).val($('#engraving-name'+1).val());
                $('#engraving-font' + i).val($('#engraving-font'+1).val())
                $('#engraving-name' + i).css("font-family",$('#engraving-font'+1).val());
            }
        }else {
            for(var i=2; i <= quantity; i++) {
                $('#engraving-name' + i).val('');
                $('#engraving-font' + i).val('Nunito Sans');
                $('#engraving-name' + i).css("font-family",'Nunito Sans');
            }
        }
    });


    /**********************************************************************************************************
    Reviews | Reviews | Reviews | Reviews | Reviews | Reviews | Reviews | Reviews | Reviews | Reviews | Reviews
    ***********************************************************************************************************/

    /** When Login User submit review then call this ajax */
    $("#button-review").click(function() {
        var data = $('#review-rating').serializeArray();
        $.ajax({
            url: "{{ __url('store-rating') }}",
            type: "POST",
            data: data
        }).then((res) => {
            console.log(res)
            if(res.error){
                    $.each( res.error, function( key, value ) {
                    toastr.error(value);
                });
            }
            if(res.msg){
                toastr.success(res.msg);
                var html = '<tr>';
                html += '<td class="review-post-type" colspan="2"><h4>'+res.review.user_id+'<h4>';
                html +='<h4  class="text-right">'+ res.review.created_at+'</h4>';
                html +='<p>'+ res.review.review +'</p>';
                html +='<div class="review-post-rating">';
                var i;
                for(i=1; i<=5; i++){
                    if(res.review.rating >= i){
                        html +='<i class="fa fa-star" aria-hidden="true"></i>';
                    }else{
                        html +='<i class="fa fa-star-o" aria-hidden="true"></i>';
                    }
                }
                html +='</div></td></tr>';
                $('table tbody').append(html);
                $('#review-rating')[0].reset();
            }

        }).catch((errorMsg) => {
            toastr.warning(errorMsg);
        });
    });


    /************************************************************************************************************
    Cart | Cart | Cart | Cart | Cart | Cart | Cart | Cart | Cart | Cart | Cart | Cart | Cart | Cart | Cart | Cart
    *************************************************************************************************************/

    /** this function call ehen user add product in cart */
    $('#addToCart').click(function(){
        var formdata = $("#form-product-filter-variation").serializeArray();
        $.getJSON('{{ __url("add-to-cart") }}', formdata, function(json, textStatus) {
            if(json){
                $('#cart-counter').html(json);
                toastr.success("{{session('toast_success')}}","Cart Added Successfully");
            }
        });
    });
</script>
