@php
    use App\ProductAttribute;
@endphp
<ul class="collapsible collapsible-accordion">
    <li class="{{ ($isFilter)?'active':'' }}">
        <div class="collapsible-header collapsible-filter">
            <div class="filter-inner">
                <i style="vertical-align: -7px;" class="material-icons">filter_list</i> Filter
            </div>
        </div>
        <div class="collapsible-body" style="background: white;display:{{ ($isFilter)?'block':'none' }}">
            <form wire:submit.prevent="search(Object.fromEntries(new FormData($event.target)))"  >
                <div class="row">
                    <div class="input-field  col s12 m6 l3">
                        <input name="title" id="search_title" type="text">
                        <label for="search_first_name">Title</label>
                    </div>
                    @if ($status == ProductAttribute::PUBLISH)
                        <div class="input-field col s12 m6 l3">
                            <input name="sku" id="search_sku"  type="text">
                            <label for="search_last_name">Design No</label>
                        </div>
                    @endif
                   <div class="input-field  col s12 m6 l3">
                        <input class=" custom-datepicker" name="from_date" id="search_from_date" type="text">
                        <label for="from_date">From</label>
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <input class=" custom-datepicker" name="to_date" id="search_to_date" type="text">
                        <label for="to_date">To</label>
                    </div>
                </div>
                <div class="row text-right">
                    <div class="col s12 m12 l12 mt-1">
                        <button class="btn cyan waves-effect waves-light" type="submit">Apply</button>
                        <a wire:click="clearFilter" class="btn cyan waves-effect waves-light ml-2">Clear Filter</a>
                    </div>
                </div>
            </form>
        </div>
    </li>
</ul>
