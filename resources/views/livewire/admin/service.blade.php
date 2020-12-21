<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                @permission('add-service')
                    <a href="{{ url('admin/service/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>

            @if(count($services) != 0)
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
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        @anypermission('edit-service','delete-service')
                                            <th>Action</th>
                                        @endanypermission
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($services as $service)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td width="150px"><img class="img-zoom-2" src="{{ @getMediaUrlToMedia($service->media) }}" height="100px" width="80px"></td>
                                            <td>{{ $service->title }}</td>
                                            <td>{!! $service->description !!}</td>
                                            @anypermission('edit-service','delete-service')
                                                <td width="100px">
                                                    <a class='dropdown-trigger' data-target='dropdown{{ $service->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                    <ul id='dropdown{{ $service->id }}' class='dropdown-content'>
                                                        @permission('edit-service')
                                                            <li><a href="{{ url('admin/service') }}/{{ $service->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
                                                        @endpermission
                                                        @permission('delete-service')
                                                            @if($service->id != 1)
                                                                <li>
                                                                    <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/service/'.$service->id) }}" data-title="Delete Service Confirmation!" data-content="Are you sure you want to delete this service?" class="common-remove-popup">
                                                                        <i class="material-icons">delete</i> Delete
                                                                    </a>
                                                                </li>
                                                            @endif
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
                                'tblData'   => $services,
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
                        <h4 class="dnf-ui-title">Sorry, Services Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
