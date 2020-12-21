<div class="col-lg-9 col-md-8 col-sm-12">
      <div class="content-wrapper">
        @if($categoryOffer->offer_banner_visibility == 1)
          {{-- Start Left Penal --}}
          @include('customer.partials.product.offer-banner')
        @endif
            
          {{-- Start Left Penal --}}
          @include('customer.partials.product.subcategory')

          {{-- Start Product Block --}}
          @include('customer.partials.product.product')
      </div>
</div>