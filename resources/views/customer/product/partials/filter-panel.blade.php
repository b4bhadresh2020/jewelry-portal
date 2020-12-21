<div class="col-lg-3 col-md-4 col-sm-12">
    <div class="left-panel">
        <div class="filter-block">
            <div class="left-title">
                <h3>filter
                    <a onclick="return clearFilter();" href="javascript:void(0);" class="clear-filter">clear filter</a>
                </h3>
            </div>
            <form id="sidebar-filter-form">
                <div class="filter-inner">
                    <div class="categories-wrapper">
                        @isset ($categories)
                            <div class="filter-title">
                                <h4>CATEGORIES</h4>
                            </div>
                            <div class="categories-block">
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input onchange="return applyFilter()" name="category[]" value="{{ $category->id }}" type="checkbox" class="form-check-input filled-in" id="category{{ $category->id }}">
                                        <label class="form-check-label" for="category{{ $category->id }}">{{ $category->{'name:'.$locale} }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                        @endisset

                        <div class="filter-title">
                            <h4>Price ($)</h4>
                        </div>
                        <div class="categories-block" style="height: 60px;">
                            <div>
                                <div class="range-fields">
                                    <input name="min_price" type="number" min="{{ MIN_PRICE_FILTER }}" max="{{ MAX_PRICE_FILTER }}" oninput="validity.valid||(value=min_price_filter);" id="min_price" class="float-left price-range-field" />
                                    <input name="max_price" type="number" min="{{ MIN_PRICE_FILTER }}" max="{{ MAX_PRICE_FILTER }}" oninput="validity.valid||(value=max_price_filter);" id="max_price" class="float-right price-range-field" />
                                </div>
                                <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                                <div id="searchResults" class="search-results-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="size-block filter-item">
                        <div class="accordion" id="filter" role="tablist" aria-multiselectable="true">
                            {{-- Load Other Filter Option --}}
                            @foreach ($attributes as $attribute)
                                @if ($attribute->option->count() > 0)
                                    <div class="card">
                                        <div class="card-header" role="tab" id="size1">
                                            <a class="collapsed" data-toggle="collapse" href="#{{ $attribute->{'name:'.$locale} }}">
                                                <h5>{{ $attribute->{'name:'.$locale} }}<i class="fa fa-angle-down" aria-hidden="true"></i></h5>
                                            </a>
                                        </div>
                                        <div id="{{ $attribute->{'name:'.$locale} }}" class="collapse tab-item" role="tabpanel" >
                                            <ul>
                                                @foreach ($attribute->option as $option)
                                                    <li>
                                                        <div class="form-check">
                                                            <input
                                                                type="checkbox"
                                                                class="form-check-input"
                                                                onchange="return applyFilter()"
                                                                name="attribute[{{ $attribute->id }}][]"
                                                                value="{{ $option->id }}"
                                                                id="option{{ $option->id }}">
                                                            <label
                                                                class="form-check-label"
                                                                for="option{{ $option->id }}">
                                                                    {{ $option->{'name:'.$locale} }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="left-product">
            <div class="left-special-product">
                <div class="left-title">
                    <h3>New Products</h3>
                </div>
                <div class="left-produvt-inner">
                    <div class="left-side-product">
                        <div class="left-side-img">
                            <img src="{{ url('assets') }}/img/product1.jpg">
                        </div>
                        <div class="left-side-text">
                            <h3><a href="#">Omnis dicam mentitum</a></h3>
                            <div class="left-side-text-price">
                                <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="left-side-product">
                        <div class="left-side-img">
                            <img src="{{ url('assets') }}/img/product1.jpg">
                        </div>
                        <div class="left-side-text">
                            <h3><a href="#">Omnis dicam mentitum</a></h3>
                            <div class="left-side-text-price">
                                <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="left-side-product">
                        <div class="left-side-img">
                            <img src="{{ url('assets') }}/img/product1.jpg">
                        </div>
                        <div class="left-side-text">
                            <h3><a href="#">Omnis dicam mentitum</a></h3>
                            <div class="left-side-text-price">
                                <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="left-product-all"><a href="">All New Products</a></div>
            </div>
        </div>
        <div class="left-benner">
            <div class="left-benner-inner">
                <a href="#">
                <img src="{{ url('assets') }}/img/left-benner.jpg">
                </a>
            </div>
        </div>
        <div class="left-product">
            <div class="left-special-product">
                <div class="left-title">
                    <h3>best sellers</h3>
                </div>
                <div class="left-produvt-inner">
                    <div class="left-side-product">
                        <div class="left-side-img">
                            <img src="{{ url('assets') }}/img/product1.jpg">
                        </div>
                        <div class="left-side-text">
                            <h3><a href="#">Omnis dicam mentitum</a></h3>
                            <div class="left-side-text-price">
                                <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="left-side-product">
                        <div class="left-side-img">
                            <img src="{{ url('assets') }}/img/product1.jpg">
                        </div>
                        <div class="left-side-text">
                            <h3><a href="#">Omnis dicam mentitum</a></h3>
                            <div class="left-side-text-price">
                                <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="left-side-product">
                        <div class="left-side-img">
                            <img src="{{ url('assets') }}/img/product1.jpg">
                        </div>
                        <div class="left-side-text">
                            <h3><a href="#">Omnis dicam mentitum</a></h3>
                            <div class="left-side-text-price">
                                <span class="product-price">₹21,350 <span class="product-regular-price"><del>₹26,688</del></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="left-product-all"><a href="">All best sellers</a></div>
            </div>
        </div>
    </div>
</div>
