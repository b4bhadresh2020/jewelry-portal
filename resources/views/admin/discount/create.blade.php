{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Discount')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
<link href="{{asset('vendors/summernote/summernote-lite.min.css')}}" rel="stylesheet">
@endsection

{{-- page content --}}
@section('content')
<div class="section">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">Create Discount</h4>
                </div>
                <div class="col s6 right-align">
                    @permission('view-discount')
                        <a href="{{ url('admin/discount') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow" >
                            <i class="material-icons left">menu</i> View  Discount
                        </a>
                    @endpermission
                </div>
            </div>

            <form method="POST" action="{{url('admin/discount')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="input-field col m7 s12">
                            <div class="col m3 p-0">
                                <span>Select Discount Type</span>
                            </div>
                             <div class="col m2">
                                <label>
                                    <input class="with-gap" name="discount_type" type="radio" value="1" {{ (old('discount_type') == 1) ? "checked" : "checked" }} />
                                    <span>Coupon</span>
                                <label>
                            </div>
                            <div class="col m2">
                                <label>
                                    <input class="with-gap" name="discount_type" type="radio" value="2" {{ (old('discount_type') == 2) ? "checked" : "" }}/>
                                    <span>Offer</span>
                                </label>
                            </div>
                    </div>
                </div>



                <div class="row" id="coupon" style="display:block;">
                    <div class="col m6 s12 file-field input-field p-0">
                        <div class="btn float-right" id="key">
                            <span>Coupon Code</span>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Coupon Code" id="auto_code" name="coupon_code" value="{{ old('coupon_code')}} ">
                            <small class="errorTxt2">
                                    @error('coupon_code')
                                    <div class="error">{{$message}}</div>
                                    @enderror
                            </small>
                        </div>
                    </div>
                </div>

                <div id="offer" style="display:none;">
                    <div class="row mt-1">
                        <div class="col s12">
                            <ul class="tabs">
                                @foreach ($findActiveLanguage as $item)
                                <li class="tab col m2"><a href="#{{$item->name}}">{{$item->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        @foreach ($findActiveLanguage as $item)
                        <div id="{{$item->name}}" class="col s12 p-0">

                            <div class="input-field col m12 s12">
                                <input id="name{{$item->id}}" type="text" value="{{ old('title:'.$item->code) }}"
                                    name="title:{{$item->code}}">
                                <label for="name{{$item->id}}">Title ({{$item->name}})</label>
                                <small class="errorTxt2">
                                    @error('title:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                            <div class="input-field col m12 s12">
                                <label for="name{{$item->id}}" style="position:unset;">Description ({{$item->name}})</label>
                                <textarea  class="summernote mt-3" name="description:{{$item->code}}">{{ old('description:'.$item->code) }}</textarea>
                                <small class="errorTxt2">
                                    @error('description:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

               <div class="row">
                    <div class="input-field col m7 s12">
                            <div class="col m3 p-0">
                                <span>Amount Type</span>
                            </div>
                             <div class="col m2">
                                <label>
                                    <input class="with-gap" name="amount_type" type="radio" value="1"  {{ (old('amount_type') == 1) ? "checked" : "" }}  />
                                    <span>Fixed*</span>
                                <label>
                            </div>
                            <div class="col m2">
                                <label>
                                    <input class="with-gap" name="amount_type" type="radio" value="2" {{ (old('amount_type') == 2) ? "checked" : "" }} />
                                    <span>Percentage*</span>
                                </label>
                            </div>
                    </div>
                </div>
                <small class="input-field errorTxt2">
                    @error('amount_type')
                    <div class="error">{{$message}}</div>
                    @enderror
                </small>

                <div class="row">
                    <div class="input-field col m7 s12">
                            <div class="col m3 p-0">
                                <span>Apply For</span>
                            </div>
                             <div class="col m2">
                                <label>
                                    <input class="with-gap" name="applicable_type" type="radio" value="category" {{ (old('applicable_type') == "category") ? "checked" : "" }}/>
                                    <span>Category</span>
                                <label>
                            </div>
                            <div class="col m2">
                                <label>
                                    <input class="with-gap" name="applicable_type" type="radio" value="subcategory" {{ (old('applicable_type') == "subcategory") ? "checked" : "" }}/>
                                    <span>Subcategory</span>
                                </label>
                            </div>
                            <div class="col m2" id="apply_user">
                                <label>
                                    <input class="with-gap" name="applicable_type" type="radio" value="user"  {{ (old('applicable_type') == "user") ? "checked" : "" }}/>
                                    <span>User</span>
                                </label>
                            </div>
                            <div class="col m2" id="apply_product" style="display:none;">
                                <label>
                                    <input class="with-gap" name="applicable_type" type="radio" value="product"  {{ (old('applicable_type') == "product") ? "checked" : "" }}/>
                                    <span>Product</span>
                                </label>
                            </div>
                    </div>
                </div>
                <small class="input-field errorTxt2">
                    @error('applicable_type')
                    <div class="error">{{$message}}</div>
                    @enderror
                </small>

                <div class="row mt-1" style="display:none;" id="category_menu">
                    <div class="col m12">
                    <span>Category</span>

                        <div class="input-field">
                            <select class="select2 browser-default" multiple="multiple" name="multiple_category_id[]">
                            <option value="" disabled >Select Category</option>
                            @foreach ($categories as $item)
                                <option @if(@in_array($item->id,old('multiple_category_id'))) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                            </select>
                             <small class="input-field errorTxt2">
                                @error('multiple_category_id')
                                <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    </div>
                </div>


                <div class="row" style="display:none;" id="subcategory_menu">

                    <div class="input-field col m12 s12">
                        <select class="select2 browser-default" name="category_id" id="category">
                            <option value="" selected disabled >Select Category</option>
                            @foreach ($categories as $item)
                                <option @if(old('category_id')==$item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <small class="input-field errorTxt2">
                                @error('category_id')
                                <div class="error">{{$message}}</div>
                                @enderror
                        </small>
                    </div>


                    <div class="col m12 s12 mt-1">
                        <span>SubCategory</span>
                        <div class="input-field">
                            <select class="select2 browser-default" multiple="multiple" id="subcategory" name="subcategory_id[]">
                            <option value="" disabled >Select Subcategory</option>
                            </select>
                            <small class="input-field errorTxt2">
                                @error('subcategory_id')
                                <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row mt-1" style="display:none;" id="user_menu">
                    <div class="col m12">
                         <span>User</span>
                        <div class="input-field">
                            <select class="select2 browser-default" multiple="multiple" name="user_id[]">
                            <option value=""  disabled>Select User</option>
                            @foreach ($users as $item)
                                    <option @if(@in_array($item->id,old('user_id'))) selected @endif value="{{$item->id}}">{{$item->first_name." ".$item->last_name}}</option>
                            @endforeach
                            </select>
                            <small class="input-field errorTxt2">
                                @error('user_id')
                                <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    </div>
                </div>

                 <div class="row mt-1" style="display:none;" id="product_menu">
                    <div class="col m12">
                        <span>Product</span>
                        <div class="input-field">
                            <select class="select2 browser-default" multiple="multiple" name="product_id[]">
                            <option value=""  disabled>Select Product</option>
                            @foreach ($users as $item)
                                    <option @if(@in_array($item->id,old('product_id'))) selected @endif value="{{$item->id}}">{{$item->first_name." ".$item->last_name}}</option>
                            @endforeach
                            </select>
                            <small class="input-field errorTxt2">
                                @error('product_id')
                                <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="input-field col s6">
                    <input id="from" type="text" class="validate from_date datepicker" name="from_date" id="from_date" value="{{old('from_date')}}">
                    <label for="from">From</label>
                        <small class="input-field errorTxt2">
                                @error('from_date')
                                <div class="error">{{$message}}</div>
                                @enderror
                        </small>
                    </div>
                    <div class="input-field col s6">
                    <input id="to" type="text" class="validate to_date datepicker" name="to_date" id="to_date" value="{{old('to_date')}}">
                    <label for="to">To</label>
                         <small class="input-field errorTxt2">
                                @error('to_date')
                                <div class="error">{{$message}}</div>
                                @enderror
                         </small>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                    <input id="icon_prefix2" type="text" class="validate" name="amount" value="{{old('amount')}}">
                    <label for="icon_prefix2">Discount</label>
                     <small class="input-field errorTxt2">
                            @error('amount')
                            <div class="error">{{$message}}</div>
                            @enderror
                    </small>
                    </div>
                    <div class="input-field col s6">
                    <input id="reedem" type="number" class="validate" name="redeem_limit" value="{{old('redeem_limit')}}">
                    <label for="reedem">No of Redeem</label>
                     <small class="input-field errorTxt2">
                                @error('redeem_limit')
                                <div class="error">{{$message}}</div>
                                @enderror
                    </small>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn cyan waves-effect waves-light ml-1" type="submit">Submit
                        <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/summernote/summernote-lite.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('js/custom/form-select2.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script type="text/javascript">
$(document).ready(function(){

    $('input[name=applicable_type]').each(function(){
        if($(this).is(":checked"))
        {
            var type = $(this).val();
            if(type == "category")
            {
                $('#category_menu').show();
            }
            else if(type == "subcategory")
            {
                $('#subcategory_menu').show();
            }
            else if(type == "user")
            {
                $('#user_menu').show();
            }
            else if(type == "product")
            {
                $('#product_menu').show();
            }

        }
    });
});

$("input[name=applicable_type]").click(function(){
    var type = $(this).val();
    if(type == "category")
    {
        $('#category_menu').show();
        $('#subcategory_menu, #user_menu, #product_menu').hide();
    }
    else if(type == "subcategory")
    {
        $('#subcategory_menu').show();
        $('#category_menu, #user_menu, #product_menu').hide();
    }
    else if(type == "user")
    {
        $('#user_menu').show();
        $('#category_menu, #subcategory_menu, #product_menu').hide();
    }
    else{
        $('#product_menu').show();
        $('#category_menu, #subcategory_menu, #user_menu').hide();
    }
});

if($( "input[name=discount_type]:checked" ).val() == 1)
{
    $('#coupon,#apply_user').show();
    $('#offer,#apply_product').hide();
}
else
{
    $('#coupon,#apply_user').hide();
    $('#offer,#apply_product').show();
}


$("input[name=discount_type]").click(function(){
     if($(this).val() == 1)
    {
        $('#coupon,#apply_user').show();
        $('#offer,#apply_product').hide();
    }
    else
    {
        $('#coupon,#apply_user').hide();
        $('#offer,#apply_product').show();
    }
});

var minNumber = 10000000;
var maxNumber = 90000000;
$('#key').on('click',function(){

    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 5; i++)
    {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    $('#auto_code').val(text);
});


$('.summernote').summernote({
    tabsize: 4,
    height: 400,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link','picture']],
        ['view', ['codeview', 'help']]
    ]
});

function insertAtCaret(areaId, text) {
    $('#'+areaId).summernote('editor.restoreRange');
    $('#'+areaId).summernote('editor.focus');
    $('#'+areaId).summernote('editor.insertText', text);
}

$('#category').on("change",function(){
    $.ajax({
        url:"{{__url('admin/discount/get-sub-category-by-category-id')}}/"+$(this).val(),
        type:"GET",
        dataType: 'json',
        success:function(data)
        {
            var len = data.length;
            $('#subcategory').html('');
            $('#subcategory').append("<option value=''  disabled>select Subcategory</option>");
            for(var i=0; i<len; i++)
            {
                 $('#subcategory').append($('<option>', {value:data[i].id, text:data[i].name}));
            }
        }
    });
});

$(function() {
$( ".from_date" ).datepicker({
    format: 'mm-dd-yyyy',
    minDate:  new Date(),
    onSelect: function(date)
    {
        $('.to_date').datepicker({
            format: 'mm-dd-yyyy',
            minDate:  date,
        });
    }
    });
  });

</script>
@endsection
