@foreach ($attributes as $key => $attribute)
    <input type="hidden" name="attribute_id[]" value="{{ $attribute['id'] }}">
    <input type="hidden" name="product_variation_id" id="product_variation_id">
    <div class="col m4 s6">
        <div class="form-group">
            <label for="attribute-size" class="text-title-field required" aria-required="true">{{ $attribute['name'] }}</label>
            <div class="ui-select-wrapper">
                <select class="ui-select select2 option{{ $key }}" id="attribute-size" name="option_id[]">
                    <option value="">Select Options</option>
                    @foreach ($attribute['options'] as $option)
                        <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
@endforeach
