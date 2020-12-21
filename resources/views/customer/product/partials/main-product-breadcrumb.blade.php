<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="breadcrumb-title">
            @if($selectedSubCategory)
                {{ $selectedSubCategory->{'name:'.$locale}  }}
            @elseif($selectedCategory)
                {{ $selectedCategory->{'name:'.$locale} }}
            @else
                Product
            @endif
        </div>
        <div class="breadcrumb-ul">
            <ul>
                <li class="breadcrumb-nav"><a href="#">HOME</a></li>
                @if($selectedSubCategory)
                    <li class="breadcrumb-nav"><a href="javascript:void(0);">Product</a></li>
                    <li class="breadcrumb-nav"><a href="javascript:void(0);">{{ $selectedCategory->{'name:'.$locale} }}</a></li>
                    <li class="breadcrumb-nav active"><a href="javascript:void(0);">{{ $selectedSubCategory->{'name:'.$locale}  }}</a></li>
                @elseif($selectedCategory)
                    <li class="breadcrumb-nav"><a href="javascript:void(0);">Product</a></li>
                    <li class="breadcrumb-nav active"><a href="javascript:void(0);">{{ $selectedCategory->{'name:'.$locale} }}</a></li>
                @else
                    <li class="breadcrumb-nav active"><a href="javascript:void(0);">Product</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
