@php
    use App\Discount;
@endphp
<div class="row">
    <div class="col s12">
        {{-- Load Filter--}}
        @include('admin.discount.filter')
        <div class="card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')=== Discount::ALL || request('status')===null ) active @endif" wire:click="changeStatus({{Discount::ALL}})" ><i class="material-icons left">dehaze</i> All Discount</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')=== Discount::PUBLISH) active @endif" wire:click="changeStatus({{Discount::PUBLISH}})"><i class="material-icons left">check</i> Active Discount</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')=== Discount::EXPIRE) active @endif" wire:click="changeStatus({{Discount::EXPIRE}})"><i class="material-icons left">do_not_disturb</i> Expire Discount</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')=== Discount::COUPON) active @endif" wire:click="changeStatus({{Discount::COUPON}})"><i class="material-icons left">credit_card</i> Coupon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')=== Discount::OFFER) active @endif" wire:click="changeStatus({{Discount::OFFER}})"><i class="material-icons left">local_offer</i> Offer</a>
                    </li>
                </ul>
                @permission('add-discount')
                    <a href="{{  url('admin/discount/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>
            @if (count($discounts) != 0 )
                <div class="card-content">
                    <div class="row" style="position: relative;">

                        <div class="col s12">
                            {{-- create table --}}
                            <table class="common-data-table bordered display striped nowrap">
                                <thead class="common-livewire-header">
                                    <tr>
                                        @if($bulkSelection)
                                            <td>
                                                <input type="checkbox" class="check-all tr dt-checkboxes">
                                            </td>
                                        @endif
                                        <th>Type</th>
                                        <th wire:click="sort('coupon_code')">Coupon/Offer
                                            @include('panels.sort-icon',[ 'sort' => 'coupon_code' ])
                                        </th>
                                        <th wire:click="sort('amount_type')">Amount Type
                                            @include('panels.sort-icon',[ 'sort' => 'amount_type' ])
                                        </th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Discount</th>
                                        <th>Redeem Limit</th>
                                        <th>Apply Type</th>
                                        <th width="100px">Status</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($discounts as $discount)

                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>
                                                @if ($discount->discount_type==1)
                                                    <span class="chip green lighten-5"><span class="green-text">Coupon</span></span>
                                                @else
                                                    <span class="chip red lighten-5"><span class="red-text">Offer</span></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($discount->discount_type==1)
                                                    {{ $discount->coupon_code}}
                                                @else
                                                    {{ $discount->title}}
                                                @endif
                                            </td>
                                            <td>{{ ($discount->amount_type == 1) ? "Fixed" : "Percentage"  }}</td>
                                            <td>{{ $discount->from_date }}</td>
                                            <td>{{ $discount->to_date }}</td>
                                            <td>{{ $discount->amount }}</td>
                                            <td>{{ $discount->redeem_limit }}</td>
                                            <td>{{@$discount->discountAssign[0]->discount_assigns_type}}</td>
                                            @if ($discount->status==1)
                                                <td> <span class="chip green lighten-5"><span class="green-text">Active</span></span></td>
                                            @else
                                                <td> <span class="chip red lighten-5"><span class="red-text">Expire</span></span></td>
                                            @endif
                                            <td>
                                                <a class='dropdown-trigger' data-target='dropdown{{ $discount->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $discount->id }}' class='dropdown-content'>
                                                    @permission('edit-discount')
                                                        @if($discount->status != 2 && $discount->discount_type != 2)
                                                            <li><a href="{{ url('admin/discount') }}/{{ $discount->id }}/edit"> Edit</a></li>
                                                        @endif
                                                    @endpermission
                                                    {{-- @if($discount->id != 1)
                                                        <li>
                                                            <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/discount/'.$discount->id) }}" data-title="Delete Discount Confirmation!" data-content="Are you sure you want to delete this discount?" class="common-remove-popup">
                                                                Delete
                                                            </a>
                                                        </li>
                                                    @endif --}}
                                                    @if($discount->status == 1 && $discount->id != 1)
                                                        <li>
                                                            <a data-url="{{ url('admin/discount/'.$discount->id.'/change-status/0') }}" data-title="Expire Discount Confirmation!" data-content="Are you sure you want to Expire this discount?" class="common-normal-link-confirmation">
                                                                Expire
                                                            </a>
                                                        </li>
                                                    @elseif($discount->id != 1)
                                                        <li>
                                                            <a data-url="{{ url('admin/discount/'.$discount->id.'/change-status/1') }}" data-title="Active Discount Confirmation!" data-content="Are you sure you want to active this discount?" class="common-normal-link-confirmation">
                                                                Active
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Load common Pagination --}}
                            @include('admin.partials.default-table-pagination',[
                                'tblData' => $discounts,
                                'livewire' => true
                            ])
                        </div>

                        {{-- Load liveWire Loading --}}
                        @include('admin.partials.wire-loading')
                    </div>
                </div>
            @else
                <div class="dnf-ui-card">
                    <div class="center-align">
                        <img width="40%" src="{{ url('assets/img/dnf-ui.jpg') }}">
                        <h4 class="dnf-ui-title">Sorry,
                            @if(request('status') === -1 || request('status') === null)
                                All Discount
                            @elseif(request('status') === 1)
                                Active Discount
                            @elseif(request('status') === 2)
                                Expire Discount
                            @elseif(request('status') === 3)
                                Coupon
                            @elseif(request('status') === 4)
                                Offer
                            @endif
                            Not Found..
                        </h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
