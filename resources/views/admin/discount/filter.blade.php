<ul class="collapsible collapsible-accordion">
    <li class="{{ ($isFilter)?'active':'' }}">
        <div class="collapsible-header collapsible-filter">
            <div class="filter-inner">
                <i style="vertical-align: -7px;" class="material-icons">filter_list</i> Filter
            </div>
        </div>
        <div class="collapsible-body" style="background: white;display:{{ ($isFilter)?'block':'none' }}">
            <div class="row">
                <form wire:submit.prevent="search(Object.fromEntries(new FormData($event.target)))"  >
                    <div class="input-field  col s12 m6 l3">
                        <input name="coupon_code" id="coupon_code" type="text">
                        <label for="coupon_code">Coupon Code</label>
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <input name="offer" id="offer"  type="text">
                        <label for="offer">Offer</label>
                    </div>
                     <div class="input-field  col s12 m6 l3">
                        <input class="datepicker" name="from_date" type="text">
                        <label for="from_date">From</label>
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <input class="datepicker" name="to_date" type="text">
                        <label for="to_date">To</label>
                    </div>
                     <div class="input-field col s12 m6 l3">
                        <input name="discount" id="discount"  type="text">
                        <label for="discount">Discount</label>
                    </div>
                     <div class="input-field col s12 m6 l3">
                        <input name="redeem_limit" id="redeem_limit"  type="text">
                        <label for="redeem_limit">Redeem limit</label>
                    </div>
                    <div class="col s12 m6 l3 mt-1">
                        <button class="btn cyan waves-effect waves-light" type="submit">Apply</button>
                        <a wire:click="clearFilter" class="btn cyan waves-effect waves-light ml-2">Clear Filter</a>
                    </div>
                </form>
            </div>
        </div>
    </li>
</ul>
