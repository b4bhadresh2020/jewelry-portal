
    <table class="table table-border responsive-table table-hover-variants">
        <thead>
            <tr>
                <th>Image</th>
                <th>Design No</th>
                @foreach ($productVariations['attributeKey'] as $attribute)
                    <th>{{ $attribute['name'] }}</th>
                @endforeach
                <th>Price</th>
                <th>Is Default?</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productVariations['item'] as $variation)
                <tr>
                    <td>
                        <div class="wrap-img-product">
                            <img src="{{ getMediaUrlToMedia($variation['image']) }}" alt="Variation image">
                        </div>
                    </td>
                    <td>{{ $variation['sku'] }}</td>
                    @foreach ($variation['options'] as $option)
                        <td>{{ $option['name'] }}</td>
                    @endforeach
                    <td>{{ $variation['price'] }}</td>
                    <td>
                        <div class="input-field" style="margin: 0 0 40px 0;">
                            <label>
                                <input name="is_default" value="{{ $variation['id'] }}" type="radio" {{ ($variation['is_default'] == 1)?'checked':'' }}>
                                <span></span>
                            </label>
                        </div>
                    </td>
                    <td style="width: 180px;" class="text-center">
                        <input type="hidden" name="product_attribute_id" value="{{ $variation['id'] }}">
                        <a href="javascript:void(0)" class="btn btn-ver green darken-3 edit-product-attributes" data-id="{{ $variation['id'] }}"><i class="material-icons dp48">mode_edit</i></a>
                        {{-- <a href="#" class="btn btn-ver red darken-3"><i class="material-icons dp48">delete</i></a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
