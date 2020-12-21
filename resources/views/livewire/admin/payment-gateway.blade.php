<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                @permission('add-payment-gateway')
                    <a href="{{ url('admin/payment-gateway/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>
            @if (count($paymentGateways) != 0)
            <div class="card-content">
                <div class="row" style="position: relative;">
                    <div class="col s12">
                        {{-- create table --}}
                        <table class="display nowrap scroll_vert_hor">
                            <thead>
                                <tr>
                                    @if($bulkSelection)
                                    <td>
                                        <input type="checkbox" class="check-all tr dt-checkboxes">
                                    </td>
                                    @endif
                                        <th>Name</th>
                                        <th>Key</th>
                                        <th>Secret</th>
                                        <th>Return Url</th>
                                        <th>Status</th>
                                        @anypermission('edit-payment-gateway')
                                            <th>Action</th>
                                        @endanypermission
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($paymentGateways as $paymentGateway)
                                    <tr data-sort-id="{{$paymentGateway->id}}">
                                        @if($bulkSelection)
                                        <td>
                                            <input type="checkbox" class="checkable tr dt-checkboxes">
                                        </td>
                                        @endif
                                        <td>{{ $paymentGateway->name }}</td>
                                        <td>{{ $paymentGateway->key }}</td>
                                        <td>{{ $paymentGateway->secret }}</td>
                                        <td>{{ $paymentGateway->return_url }}</td>
                                         <td> <div class="switch">
                                            <label>
                                              <input type="checkbox" onclick="changeStatus({{ $paymentGateway->id }})"  {{ $paymentGateway->status == 1 ? 'checked' : '' }}>
                                              <span class="lever"></span>
                                            </label>
                                          </div>
                                        </td>
                                        @anypermission('edit-payment-gateway')
                                            <td width="100px">
                                                <a class='dropdown-trigger' data-target='dropdown{{ $paymentGateway->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $paymentGateway->id }}' class='dropdown-content'>
                                                    @permission('edit-payment-gateway')
                                                        <li><a href="{{ url('admin/payment-gateway') }}/{{ $paymentGateway->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
                                                    @endpermission
                                                </ul>
                                            </td>
                                        @endanypermission
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{-- Load common Pagination --}}
                            @include('admin.partials.default-table-pagination',[
                                'tblData'   => $paymentGateways,
                                'livewire'  => true
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
                        <h4 class="dnf-ui-title">Sorry, Offers Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
