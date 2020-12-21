<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                @permission('add-blog')
                    <a href="{{ url('admin/blog/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>
            @if(count($blogs) != 0)
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
                                        <th>image</th>
                                        <th>title</th>
                                        <th>Short Description</th>
                                        <th>Long Description</th>
                                        @anypermission('edit-blog', 'delete-blog')
                                            <th>Action</th>
                                        @endanypermission
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                @foreach($blogs as $blog)
                                    <tr>
                                        @if($bulkSelection)
                                            <td>
                                                <input type="checkbox" class="checkable tr dt-checkboxes">
                                            </td>
                                        @endif
                                        <td width="150px"><img class="img-zoom-2" src="{{ url('storage/'.$blog->image) }}" height="100px" width="80px"></td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->short_description}}</td>
                                        <td>{!! $blog->long_description !!}</td>
                                        @anypermission('edit-blog', 'delete-blog')
                                            <td width="100px">
                                                <a class='dropdown-trigger' data-target='dropdown{{ $blog->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $blog->id }}' class='dropdown-content'>
                                                    @permission('edit-blog')
                                                        <li><a href="{{ url('admin/blog') }}/{{ $blog->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
                                                    @endpermission

                                                    @permission('delete-blog')
                                                        <li>
                                                            <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/blog/'.$blog->id) }}" data-title="Delete Blog  Confirmation!" data-content="Are you sure you want to delete this Blog ?" class="common-remove-popup">
                                                                <i class="material-icons">delete</i> Delete
                                                            </a>
                                                        </li>
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
                                'tblData'   => $blogs,
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
                        <h4 class="dnf-ui-title">Sorry, Blogs Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
