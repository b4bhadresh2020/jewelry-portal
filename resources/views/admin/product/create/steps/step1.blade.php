<form method="post" id="product-form-step-1">
    @csrf
    <section class="_pb-2">
            <input type="hidden" class="product_id" name="product_id">
            <div class="row" id="main-view">
                <div class="row mb-1 category-block">
                    <div class="col s6">
                        <select class="display select2 category-step-2" name="category_id" required  id="step-2-category_id">
                            <option value disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s6 sub-category-dropdown-step-2" style="display: none">
                        <select class="display select2 sub_category-step-2" name="sub_category_id" required id="sub_category_id">
                            <option value="" disabled selected>Select Sub Category</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col s12">
                        <div class="row ml-1 mt-1">
                            <h5><b>Collections</b></h5>
                            <span class="checkbox-block mr-1">
                                <label for="all-collection">
                                    <input id="all-collection" type="checkbox">
                                    <span class="_pl-25">All</span>
                                </label>
                            </span>
                            @foreach ($collections as $collection)
                                <span class="checkbox-block mr-1">
                                    <label for="collection_name{{$collection->id}}">
                                        <input id="collection_name{{$collection->id}}" type="checkbox" class="collection-checkbox" name="collection_name[{{$collection->id}}]">
                                        <span class="_pl-25">{{$collection->name}}</span>
                                    </label>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col s12">
                        <div class="row ml-1 mt-1">
                            <span class="checkbox-block mr-1">
                                <label for="is_custom">
                                    <input value="1" id="is_custom" name="is_custom" type="checkbox">
                                    <span class="_pl-25">Custom Product</span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col s6">
                        <label for="">Related Products</label>
                        <select class="display select2" name="related_products[]" id="related_products" multiple>
                            @foreach ($relatedProducts as $relatedProduct)
                                <option value="{{$relatedProduct->id}}">{{$relatedProduct->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <ul id="tabs" class="tabs tab-demo z-depth-1">
                            @foreach ($findActiveLanguage as $language)
                                <li class="tab"><a class="active" href="#tab-{{$language->code}}">{{$language->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="row mt-1">
                            @foreach ($findActiveLanguage as $language)
                                <div id="tab-{{$language->code}}" class="col s12">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input name="title:{{$language->code}}" id="title{{$language->id}}" type="text" autocomplete="false" {{$language->code == 'en'?'required':''}}>
                                            <label for="title{{$language->id}}">Title ({{$language->name}})</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <label for="description{{$language->id}}"  style="position: unset">Description ({{$language->name}})</label>
                                            <textarea name="description:{{$language->code}}" class="summernote mt-2" id="description{{$language->id}}" type="text" class="validate"></textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="step-footer">
        <button class="waves-effect waves-light btn mb-1 mr-1" id="btnNext" type="button">Save And Continue</button>
    </div>
</form>
