{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Product')
{{-- page content --}}
{{-- vendor style --}}

@section('vendor-style')
    <link href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendors/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendors/select2/select2-materialize.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendors/summernote/summernote-lite.min.css')}}" rel="stylesheet" type="text/css">
@endsection

{{-- page style --}}
@section('page-style')
    <link href="{{asset('css/custom/form-wizard.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="section section-product-wizard">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content pb-0">
                        <div class="step-app" id="demo">
                            <ul class="step-steps">
                                <li data-step-target="step1">1. Product Details</li>
                                <li data-step-target="step2">2. Product Variations</li>
                            </ul>
                            <div class="step-content">
                                <div class="step-tab-panel" data-step="step1">
                                    @include('admin.product.create.steps.step1')
                                </div>
                                <div class="step-tab-panel" data-step="step2">
                                    @include('admin.product.create.steps.step2')
                                </div>
                            </div>
                            {{-- <div class="step-footer">
                                <button id="btnPrev" class="step-btn">Previous</button>
                                <button id="btnNext" class="step-btn">Next</button>
                                <button id="btnFinish" class="step-btn">Finish</button>
                            </div> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>


        {{-- Start All Models --}}

        {{-- Add Product Variation Model --}}
        <form action="productVariationForm" id="product-variation-form" method="post" enc-type="multipart-form/data">
            @csrf
            <input type="hidden" class="product_id" name="product_id">
            <input type="hidden" name="product_attribute_id" id="product_attribute_id">
            <input type="hidden" id="deletedMedia" name="deleted_media" >
            <div id="addProductVariationModel" class="modal">
                <div class="modal-header bg-info">
                    <h5 class="modal-title"><i class="til_img"></i><strong class="white-color product-variation-form-title">Add new variation</strong></h5>
                </div>
                <div class="modal-content">
                    <div class="variation-form-wrapper">
                        <div class="row attribute-dropdowns"></div>
                        <div class="row mt-1">
                            <div class="col m4">
                                <div class="input-field">
                                    <i class="material-icons prefix refresh-sku pointer">refresh</i>
                                    <label for="sku" class="text-title-field">Design No</label>
                                    <input class="next-input" id="sku" data-counter="30" name="sku" type="text" required>
                                </div>
                            </div>
                            <div class="col m4">
                                <div class="form-group ">
                                    <label for="sell_price" class="text-title-field">Price sale</label>
                                    <input class="next-input" id="sell_price" data-counter="30" name="sell_price" type="number" required>
                                </div>
                            </div>
                            <div class="col m4">
                                <div class="form-group ">
                                    <label for="mrp" class="text-title-field">Price</label>
                                    <input class="next-input" id="mrp" data-counter="30" name="mrp" type="number" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col m4">
                                <div class="form-group ">
                                    <label for="stock" class="text-title-field">Stock</label>
                                    <input class="next-input" id="stock" data-counter="30" name="stock" type="number" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col m4">
                                <div class="form-group ">
                                    <label class="text-title-field">Default Image</label>
                                    <div class="file-field input-field default-img-block">
                                        <div class="btn float-right">
                                            <span>File</span>
                                            <input type="file" name="default_image" id="default_image" required>
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="product-image-block">
                                    <div class="p-2 product-default-image-inner">

                                    </div>
                                </div>
                            </div>
                            <div class="col m4">
                                <div class="form-group ">
                                    <label class="text-title-field">Other Image</label>
                                    <div class="file-field input-field">
                                        <div class="btn float-right">
                                            <span>File</span>
                                            <input type="file" name="multiple_image[]" multiple>
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="product-image-block">
                                    <div class="p-2 product-multiple-image-inner">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
                    <button id="saveProductVariation" type="submit" class="light-blue accent-3 btn-flat">Save</button>
                </div>
            </div>
        </form>
        {{-- End All Models --}}


    </div>
@endsection

{{-- vendor script --}}
@section('vendor-script')
    <script src="{{asset('vendors/summernote/summernote-lite.min.js')}}"></script>
    <script src="{{ asset('vendors/select2/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <script src="{{ asset('js') }}/dist/jquery-steps.js"></script>
@endsection

{{-- page script --}}
@section('page-script')
    @include('admin.product.create.script')
@endsection
