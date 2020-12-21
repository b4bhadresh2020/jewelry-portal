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
                        <input name="name" id="search_name" type="text">
                        <label for="search_name">Name</label>
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <input name="email" id="search_email"  type="text">
                        <label for="search_email">Email</label>
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <input name="from_date" class="datepicker" id="search_date"  type="text">
                        <label for="search_date">From Date</label>
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <input name="to_date" class="datepicker" id="search_date"  type="text">
                        <label for="search_date">To Date</label>
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <input name="phone_number" id="search_phone_number"  type="text">
                        <label for="search_phone_number">
                            Phone Number</label>
                    </div>

                    <div class="col s12 m6 l6 mt-1">
                        <button class="btn cyan waves-effect waves-light" type="submit">Apply</button>
                        <a wire:click="clearFilter" class="btn cyan waves-effect waves-light ml-2">Clear Filter</a>
                    </div>
                </form>
            </div>
        </div>
    </li>
</ul>
