<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            {{-- <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                <a href="{{ url('admin/offer/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                    <i class="material-icons left">add</i> Add New
                </a>
            </div> --}}
            @if (count($offers) != 0)
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
                                        <th>Header</th>
                                        <th>Title</th>
                                        <th>Link Text</th>
                                        <th>Link Url</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        @anypermission('edit-offer')
                                            <th>Action</th>
                                        @endanypermission
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($offers as $offer)
                                    <tr data-sort-id="{{$offer->id}}">
                                        @if($bulkSelection)
                                        <td>
                                            <input type="checkbox" class="checkable tr dt-checkboxes">
                                        </td>
                                        @endif
                                        @if($offer->offer_image!=null)
                                            <td width="150px"><img class="img-zoom-2" src="{{ url('storage/'.$offer->offer_image) }}" height="100px" width="80px"></td>
                                        @else
                                            <td width="150px"><img class="img-zoom-2" src="{{url('default/not-found.png')}}" height="100px" width="80px"></td>
                                        @endif
                                        <td>{{ $offer->header }}</td>
                                        <td>{{ $offer->title }}</td>
                                        <td>{{ $offer->link_text }}</td>
                                        <td>{{ $offer->link_url }}</td>
                                        <td>{{ $offer->description }}</td>
                                        <td> <div class="switch">
                                            <label>
                                              <input type="checkbox" onclick="changeStatus({{ $offer->id }})"  {{ $offer->status == 0 ? 'checked' : '' }}>
                                              <span class="lever"></span>
                                            </label>
                                          </div>
                                        </td>
                                        @anypermission('edit-offer')
                                            <td width="100px">
                                                <a class='dropdown-trigger' data-target='dropdown{{ $offer->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $offer->id }}' class='dropdown-content'>
                                                    @permission('edit-offer')
                                                        <li><a href="{{ url('admin/offer') }}/{{ $offer->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
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
                                'tblData'   => $offers,
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
