<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                @permission('add-option')
                    <a href="{{ url('admin/option/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>

            @if(count($options) != 0)
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <table class="display nowrap scroll_vert_hor">
                                <thead>
                                    <tr>
                                        @if($bulkSelection)
                                            <td>
                                                <input type="checkbox" class="check-all tr dt-checkboxes">
                                            </td>
                                        @endif
                                        <th>Attribute</th>
                                        <th>Name</th>
                                        @anypermission('edit-option')
                                            <th>Action</th>
                                        @endanypermission
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($options as $option)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>{{ $option->attribute->name }}</td>
                                            <td>{{ $option->name }}</td>
                                            @anypermission('edit-option')
                                                <td width="100px">
                                                    <!-- Dropdown Trigger -->
                                                    <a class='dropdown-trigger' data-target='dropdown{{ $option->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                    <!-- Dropdown Structure -->
                                                    <ul id='dropdown{{ $option->id }}' class='dropdown-content'>
                                                        @permission('edit-option')
                                                            <li><a href="{{ url('admin/option') }}/{{ $option->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
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
                                'tblData'   => $options,
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
                        <h4 class="dnf-ui-title">Sorry, Options List Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
