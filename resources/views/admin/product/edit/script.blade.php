<script>
    //https://github.com/rstaib/jquery-steps/wiki
    $(document).ready(function(){

        // Veriable declaration & defination
        var category_handle = @json($category_handle),
            isLoad = true,
            productSuccessStatus = deleteDefaultImage = false,
            productId,
            step1Response = productAttributes = editProductAttr = hasSubCategory = null;

        let deleteMediaIds = [];

        // Form Wizard / Stepper
        var steps = $('#demo').steps({
            onFinish: function () {

            }
        });
        steps_api = steps.data('plugin_Steps');

        $('#btnPrev').on('click', function () {
            steps_api.prev();
        });

        // User click Next Button In step 1 Then fire below logic
        $('#btnNext').on('click', function () {
            // Start Get form data
            var data = $('#product-form-step-1').serializeArray();
            // End form data

            // Start Category Validation
            var subCategory = data.find((obj)=>{
                return obj.name == "sub_category_id";
            }) || null;

            if (hasSubCategory === null) {
                toastr.error("Please Select Category"); return;
            }else{
                if (hasSubCategory === true && subCategory === null) {
                    toastr.error("Please Select SubCategory"); return;
                }
            }
            // End Category Validation

            // Start ajax
            ajaxFire({
                url : "{{ __url('admin/product/ajax/product-details') }}",
                type : "POST",
                data:  data,
            }).then((res) => {
                toastr.success("Product Details Save Successfully");
                step1Response = res;
                productId = step1Response.product_id;
                productAttributes = step1Response.product_attributes.item;
                $('.product_id').val(productId);
                $('.attribute-dropdowns').html(step1Response.attribute_list);
                $('.product-variations-table').html(step1Response.productVariations);
                $('.ui-select').formSelect();
                steps_api.next();
            }).catch((errorMsg) => {
                toastr.warning(errorMsg);
            });
            // End ajax
        });

        $(document).on('click', '#saveProductVariation', function(e) {
            e.preventDefault();
            var formData = new FormData(document.getElementById("product-variation-form")); // Get form data
            if ($('#default_image').val() == "" && deleteDefaultImage) {
                toastr.error("Default Image is required"); return;
            }

            // Start ajax
            ajaxFire({
                url : "{{ __url('admin/product/ajax/product-variation') }}",
                type : "POST",
                data:  formData,
                dataType: "json",
                processData: false,
                contentType: false
            }).then((res) => {
                $('#addProductVariationModel').modal('close');
                $('#product-variation-form').trigger("reset");
                $('.product-default-image-inner').html("");
                $('.product-multiple-image-inner').html("");
                $('.product_id').val(productId);
                $('.product-variations-table').html(res.productVariations);
                productAttributes = res.item;
                resetDeletedImageArr();
                var action = (productId)?"Save":"Updated";
                toastr.success("Product Attribute "+action+" Successfully");
                deleteDefaultImage = false;
            }).catch((errorMsg,res) => {
                toastr.warning(errorMsg);
            });
            // End ajax
        });

        // edit-product-attributes
        $(document).on('click', '.edit-product-attributes', function(){
            var editProductAttr = productAttributes.filter(element => element.id === $(this).data('id'));
            editProductAttr = editProductAttr[0];
            $('#sku').val(editProductAttr.product_variation.sku);
            $('#mrp').val(editProductAttr.product_variation.product_price.mrp);
            $('#sell_price').val(editProductAttr.product_variation.product_price.sell_price);
            $('#stock').val(editProductAttr.product_variation.stock);
            $('#product_attribute_id').val(editProductAttr.product_variation.id);

            editProductAttr.option_ids.forEach((element,i) => {
                $('.option'+i).val(element.id).formSelect();
            });

            var defaultImage = getMedia(editProductAttr.product_variation.images, 1);
            var multipleImages = getMedia(editProductAttr.product_variation.images, 0);
            $('.product-default-image-inner').html(defaultImage);
            $('.product-multiple-image-inner').html(multipleImages);
            $('#addProductVariationModel').modal('open');
            $('.product-variation-form-title').text('Edit variation');
            $('#sku').attr('disabled', true);
            $('.refresh-sku').hide();
            M.updateTextFields();
            resetDeletedImageArr();
        });

        // Load Basic Script
        commonScript();

        /* Fire On Main Category On Change */
        $(document).on('change', '.category-step-2', function() {
            var categoryId = $(this).val();
            $.ajax({
                url: "{{__url('admin/product/ajax/category')}}/" + categoryId + "/sub-category",
                type: "GET",
                success: function(data){
                    var sub_category =  '<option value="" disabled selected>Select Sub Category</option>';
                    $.each(data.subCategories, function (i, element) {
                        sub_category += '<option value='+element.id+'>'+element.name+'</option>';
                    });

                    subCategories = data.totalSubCategories;
                    $('.sub_category-step-2').html(sub_category);
                    if (data.totalSubCategories > 0) {
                        $('.sub-category-dropdown-step-2').show();
                        hasSubCategory = true;
                    }else{
                        $('.sub-category-dropdown-step-2').hide();
                        hasSubCategory = false;
                    }


                    if(category_handle.isSubCategory && isLoad){
                        isLoad = false;
                        $('.sub_category-step-2').val(category_handle.sub_category_id).trigger('change');
                    }
                }
            });
        });

        /* Delete Images */
        $(document).on('click', '.media-image', function(){
            let item = $(this);
            var mediaId    = item.data('id');
            if (item.data('name') == 'default') {
                deleteDefaultImage = true;
            }
            $.confirm({
                title: "Delete Product Attribute Image",
                content: "Are You Sure You Want To Delete This Image!",
                boxWidth: '30%',
                useBootstrap: false,
                buttons: {
                    Yes: () => {
                        item.remove();
                        deleteMediaIds.push(mediaId);
                        $('#deletedMedia').val(deleteMediaIds);
                    },
                    No: function(){}
                }
            });
        });

        /* Open Add variation Modal */
        $('.addProductVariationbtn').click(function(){
            $('#addProductVariationModel').modal('open');
            $('#product-variation-form').trigger("reset");
            $('.product_id').val(productId);
            $('.product-default-image-inner').html("");
            $('.product-multiple-image-inner').html("");
            $('#product_attribute_id').val(null);
            $('#product_variation_id').val(null);
            $('.product-variation-form-title').text('Add new variation');
            $('#sku').removeAttr('disabled');
            $('.refresh-sku').show();
            $('#sku').val(genrateSku());
            resetDeletedImageArr();
            M.updateTextFields();
        });


        $('.category-step-2').val(category_handle.category_id).trigger('change');
    });

    /* Genrate random sku */
    $('.refresh-sku').click(function(){
        if ($('#product_attribute_id').val() != null) {
            $('#sku').val(genrateSku());
        }
    });

    function ajaxFire(config){
        return new Promise((resolve, reject) => {
            let loader = ajexLoader('Loading!', 'Please wait until process is not complete...');
            $.ajax({
                ...config,
                success: function (successResult) {
                    $('.validate-error').remove();
                    loader.close();
                    resolve(successResult);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if (xhr && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(key,val){
                            $('input[name="'+key+'"]').after('<span class="validate-error error">'+val[0]+'</span>');
                        });
                    }else{
                        toastr.warning(errorMsg);
                    }
                    reject(thrownError);
                    loader.close();
                }
            });
        });
    }

    function getMedia(images, is_default) {
        var imgHtml = '';
        $.each(images, ( i, img ) => {
            if (img.is_default == is_default) {
                $.each(img.media, ( i, value ) => {
                    imgType = (is_default)?'default':'multiple';
                    imgHtml += '<a href="javascript:void(0)"><img class="img-zoom-2 mr-3 media-image" src="{{ url("storage") }}/'+value.path+'" data-id='+value.mediable_id+' data-name='+imgType+' height="40px" width="40px"></a>';
                });
            }
        });

        return imgHtml;
    }

    function ajexLoader(title, content) {
        return $.dialog({
            icon: 'fa fa-spinner fa-spin',
            boxWidth: '30%',
            useBootstrap: false,
            title: title,
            content: content,
            buttons:{}
        });
    }

    function commonScript(){
        // $(".tabs").tabs();
        $('.summernote').summernote({
            tabsize: 4,
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link','picture']],
                ['view', ['codeview', 'help']]
            ]
        });

        /* all collection */
        $(document).on('click','#all-collection',function () {
            if ($(this).prop('checked')==true){
                $('.collection-checkbox').prop('checked', true);
            }else{
                $('.collection-checkbox').prop('checked', false);
            }
        });

        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });
        $('.tabs').tabs();

        /* Select Related Product */
        var relatedProducts = '{!! $productDetails->related_products !!}';
        relatedProducts = relatedProducts.split(',');
        $('#related_products').val(relatedProducts).change();
    }

    function genrateSku() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for (var i = 0; i < 6; i++)
        {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return text;
    }

    function resetDeletedImageArr() {
        deleteMediaIds = [];
        $('#deletedMedia').val("");
    }
</script>
