{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Assign Attribute')
{{-- page content --}}

@section('content')
    <div class="section">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <div class="row">
                    <div class="col s6">
                        <h4 class="card-title">Assign Attribute</h4>
                    </div>
                </div>
                <form method="POST" action="{{url('admin/assign-attr/assign-attribute')}}">
                    @csrf
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <select class="form-select category" name="category_id">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories as $item)
                                    <option @if(old('category_id')==$item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <small class="errorTxt2">
                                @error('category_id')
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                        <div class="input-field col m6 s12">
                            <div class="sub-category-dropdown" style="display: none">
                                <select class="form-select sub_category" name="sub_category_id">
                                    <option value="" disabled selected>Select Sub Category</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col s12">
                            <h5 class="text-bold">Attribute</h5>
                            <div class="row">
                                <div class="col s12 checkbox-block">
                                    <label for="all-attr">
                                        <input id="all-attr" name="all" type="checkbox">
                                        <span>All</span>
                                    </label>
                                </div>
                            </div>
                            @foreach ($attributes as $item)
                                <div class="row">
                                    <div class="col s12 checkbox-block">
                                        <label for="is_visible{{$item->id}}">
                                            <input id="is_visible{{$item->id}}" class="attrbute-checkbox" name="attribute_id[{{$item->id}}]" type="checkbox">
                                            <span>{{$item->name}}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row assign-btn">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light left" type="submit">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- page script --}}
@section('page-script')
    <script>
        $(document).ready(function() {
            $(document).on('click','#all-attr',function () {
                $('.attrbute-checkbox').trigger('click');
            });

            $(document).on('change', '.category', function() {
                var categoryId = $(this).val();
                $.ajax({
                    url: "{{ __url('admin/assign-attr/category') }}/"+categoryId,
                    type: "GET",
                    success: function(data){
                        resetAssignAttribute();
                        var sub_category =  '<option value="" disabled selected>Select Sub Category</option>';
                        $.each(data.subCategories, function (i, element) {
                            sub_category += '<option value='+element.id+'>'+element.name+'</option>';
                        });
                        $('.sub_category').html(sub_category).formSelect();

                        if (data.totalSubCategories > 0) {
                            $('.sub-category-dropdown').show();
                            $("input[name='checkbox_name']").prop('checked', false);
                        }else{
                            $('.sub-category-dropdown').hide();
                            $.each(data.attributes, function (key, element) {
                                $('#is_visible'+element.attribute_id).prop('checked', true);
                            });

                            handleSubmitButton(data.totalProduct);
                        }
                    }
                });
            });

            $(document).on('change', '.sub_category', function() {
                var subCategoryId = $(this).val();
                $.ajax({
                    url: "{{__url('admin/assign-attr/sub-category/attribute')}}/"+subCategoryId,
                    type: "GET",
                    success: function(data){
                        resetAssignAttribute();
                        $.each(data.attributes, function (key, element) {
                            $('#is_visible'+element.attribute_id).prop('checked', true);
                        });

                        handleSubmitButton(data.totalProduct);
                    }
                });
            });

            function resetAssignAttribute(){
                $('.attrbute-checkbox').prop('checked', false);
            }

            function handleSubmitButton(totalProducts){
                if (totalProducts == 0) {
                    $('.assign-btn').show();
                }else{
                    $('.assign-btn').hide();
                    toastr.error("Products Are Available For This Categories, So You Can Not Change!")
                }
            }
        });
    </script>
@endsection
