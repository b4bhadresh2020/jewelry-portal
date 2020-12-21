<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                @permission('add-testimonial')
                    <a href="{{ url('admin/testimonial/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>
            @if(count($testimonials) != 0)
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
                                        <th>Name</th>
                                        <th>Role</th>
                                        @anypermission('edit-testimonial','delete-testimonial')
                                            <th>Action</th>
                                        @endanypermission
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($testimonials as $testimonial)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td width="150px"><img class="img-zoom-2" src="{{ @getMediaUrlToMedia($testimonial->media) }}" height="100px" width="80px"></td>
                                            <td>{{ $testimonial->name }}</td>
                                            <td>{{ $testimonial->role }}</td>
                                            @anypermission('edit-testimonial','delete-testimonial')
                                                <td width="100px">
                                                    <a class='dropdown-trigger' data-target='dropdown{{ $testimonial->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                    <ul id='dropdown{{ $testimonial->id }}' class='dropdown-content'>
                                                        @permission('delete-testimonial')
                                                            <li>
                                                                <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/testimonial/'.$testimonial->id) }}" data-title="Delete Testimonial Confirmation!" data-content="Are you sure you want to delete this Testimonial?" class="common-remove-popup">
                                                                    <i class="material-icons">delete</i> Delete
                                                                </a>
                                                            </li>
                                                        @endpermission
                                                        @permission('edit-testimonial')
                                                            <li><a href="{{ url('admin/testimonial') }}/{{ $testimonial->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
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
                                'tblData'   => $testimonials,
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
                        <h4 class="dnf-ui-title">Sorry, Testimonials List Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
