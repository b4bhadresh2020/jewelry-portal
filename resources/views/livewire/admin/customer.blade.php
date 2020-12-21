<div class="row">
    <div class="col s12">
        {{-- Load Filter--}}
        @include('admin.customer.filter')

        <div class="card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')===-1 || request('status')===null) active @endif" wire:click="changeStatus()" ><i class="material-icons left">dehaze</i> All Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')===1) active @endif" wire:click="changeStatus(1)"><i class="material-icons left">check</i> Active Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('status')===0) active @endif" wire:click="changeStatus(0)"><i class="material-icons left">do_not_disturb</i> Block Customer</a>
                    </li>
                </ul>
            </div>
            @if (count($customers) != 0)
                <div class="card-content">
                    <div class="row" style="position: relative;">

                        <div class="col s12">
                            {{-- create table --}}
                            <table class="common-data-table bordered display striped nowrap">
                                <thead class="common-livewire-header">
                                    <tr>
                                        @if($this->bulkSelection)
                                            <td>
                                                <input type="checkbox" class="check-all tr dt-checkboxes">
                                            </td>
                                        @endif
                                        <th wire:click="sort('first_name')">First Name
                                            @include('panels.sort-icon',[ 'sort' => 'first_name' ])
                                        </th>
                                        <th wire:click="sort('last_name')">Last Name
                                            @include('panels.sort-icon',[ 'sort' => 'last_name' ])
                                        </th>
                                        <th wire:click="sort('phone')">Phone
                                            @include('panels.sort-icon',[ 'sort' => 'phone' ])
                                        </th>
                                        <th wire:click="sort('email')">E-mail
                                            @include('panels.sort-icon',[ 'sort' => 'email' ])
                                        </th>
                                        <th wire:click="sort('created_at')">Register Date
                                            @include('panels.sort-icon',[ 'sort' => 'created_at' ])
                                        </th>

                                        <th width="100px">Status</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="table-tr-icons">
                                    @foreach ($customers as $customer)
                                        <tr>
                                            @if($this->bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>{{ $customer->first_name }}</td>
                                            <td>{{ $customer->last_name }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ date('d-m-Y',strtotime($customer->created_at)) }}</td>
                                            @if ($customer->status==1)
                                                <td> <span class="chip green lighten-5"><span class="green-text">Active</span></span></td>
                                            @else
                                                <td> <span class="chip red lighten-5"><span class="red-text">Block</span></span></td>
                                            @endif
                                            <td>
                                                <a class='dropdown-trigger' data-target='dropdown{{ $customer->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $customer->id }}' class='dropdown-content'>
                                                    @permission('view-customer')
                                                        <li><a href="{{ url('admin/customer') }}/{{ $customer->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
                                                    @endpermission
                                                    {{-- @if($customer->id != 1)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/customer/'.$customer->id) }}"
                                                                data-title="Delete Customer Confirmation!"
                                                                data-content="Are you sure you want to delete this customer?"
                                                                class="common-remove-popup">
                                                                    <i class="material-icons">delete</i> Delete
                                                            </a>
                                                        </li>
                                                    @endif --}}
                                                    @if($customer->status == 1 && $customer->id != 1)
                                                        <li>
                                                            <a
                                                                data-url="{{ url('admin/customer/status/'.$customer->id."/0") }}"
                                                                data-title="Block Customer Confirmation!"
                                                                data-content="Are you sure you want to block this customer?"
                                                                class="common-normal-link-confirmation">
                                                                    <i class="material-icons">do_not_disturb</i> Block
                                                            </a>
                                                        </li>
                                                    @elseif($customer->id != 1)
                                                        <li>
                                                            <a
                                                                data-url="{{ url('admin/customer/status/'.$customer->id."/1") }}"
                                                                data-title="Active Customer Confirmation!"
                                                                data-content="Are you sure you want to active this customer?"
                                                                class="common-normal-link-confirmation">
                                                                    <i class="material-icons">check</i> Active
                                                            </a>
                                                        </li>
                                                    @endif
                                                    {{-- <li>
                                                        <a href="javascript:void(0)">
                                                            <i class="material-icons">person</i> Login As Customer
                                                        </a>
                                                    </li> --}}
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Load common Pagination --}}
                            @include('admin.partials.default-table-pagination',[
                                'tblData' => $customers,
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
                        <h4 class="dnf-ui-title">Sorry, @if(request('status')===-1 || request('status')===null) Active @elseif(request('status')===1) Active @elseif(request('status')===0) Block @endif Customers Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
