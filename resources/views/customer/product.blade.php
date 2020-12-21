@extends('customer.layouts.layoutMaster')

{{-- page title --}}
@section('title','Product')

{{-- defind style page level --}}
@section('page-style')
    @livewireStyles
@endsection

{{-- defind content --}}
@section('content')
    {{-- Start Category Banner --}}
    @include('customer.partials.product.banner')

    {{-- Start Inner Page --}}
    @include('customer.partials.product.inner-page')

@endsection

{{-- defind script page level --}}
@section('page-script')
<script type="text/javascript">
function findProductBySubcategory(subcategoryId)
{
    $('.subcategory-img').removeAttr('style');
    $('#subcategory-'+subcategoryId).parent().css('border','1px dashed #eccd4f');
    $.ajax({
        url: BASEURL + '/subcategory-by-product/'+subcategoryId,
        type: 'GET',
        success:function(res)
        {
            $('#all_product').html(res);
            $('#list').css('display','none');
        }
    });
}
</script>
@endsection
