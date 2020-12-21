<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                @permission('add-collection')
                    <a href="{{ url('admin/collection/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>
            @if (count($collections) != 0)
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
                                        @anypermission('edit-collection')
                                            <th>Action</th>
                                        @endanypermission
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($collections as $collection)
                                    <tr data-sort-id="{{$collection->id}}">
                                        @if($bulkSelection)
                                            <td>
                                                <input type="checkbox" class="checkable tr dt-checkboxes">
                                            </td>
                                        @endif

                                        <td>{{ $collection->name }}</td>

                                        @anypermission('edit-collection')
                                            <td width="100px">
                                                <a class='dropdown-trigger' data-target='dropdown{{ $collection->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $collection->id }}' class='dropdown-content'>
                                                    @permission('edit-collection')
                                                        <li><a href="{{ url('admin/collection') }}/{{ $collection->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
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
                                'tblData'   => $collections,
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
