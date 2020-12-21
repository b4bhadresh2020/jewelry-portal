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
                        <input name="first_name" id="search_first_name" type="text">
                        <label for="search_first_name">First Name</label>
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <input name="last_name" id="search_last_name"  type="text">
                        <label for="search_last_name">Last Name</label>
                    </div>
                    <div class="input-field  col s12 m6 l3">
                        <input name="phone" id="search_phone" type="text">
                        <label for="search_phone">Phone Number</label>
                    </div>
                    <div class="input-field col s12 m6 l3">
                        <input name="email" id="search_email"  type="text">
                        <label for="search_email">Email</label>
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
