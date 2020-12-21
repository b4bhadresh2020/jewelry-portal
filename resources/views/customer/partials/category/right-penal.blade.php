<div class="col-lg-9 col-md-8 col-sm-12">
      <div class="content-wrapper">
        @if($categoryOffer->offer_banner_visibility == 1)
          {{-- Start Left Penal --}}
          @include('customer.partials.category.offer-banner')
        @endif
            
            {{-- Start Left Penal --}}
          @include('customer.partials.category.subcategory')

          {{-- Start Left Penal --}}
          @include('customer.partials.category.product')
      </div>
</div>