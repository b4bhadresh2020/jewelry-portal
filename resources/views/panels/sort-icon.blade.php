@if($sort !== request('sort_field'))
    <i class="fa fa-sort" aria-hidden="true"></i>
@elseif(request('sort_direction') == "ASC")
    <i class="fa fa-sort-asc va-minus-2" aria-hidden="true"></i>
@else
    <i class="fa fa-sort-desc va-plus-2" aria-hidden="true"></i>
@endif
