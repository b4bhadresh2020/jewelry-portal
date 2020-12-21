<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                @developer
                    <a href="{{ url('admin/attribute/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @enddeveloper
            </div>
            @if(count($attributes) != 0)
                <div class="card-content">
                    <div class="row">
                        {{-- create table --}}
                        <div class="col s12">
                               <form id="form" method="post">
                                    @csrf
                                    <input type="hidden" name="action" value="saveAddMore">
                                    <table class="display sortable" id="sortable">
                                        <thead>
                                            <tr>
                                                @if($bulkSelection)
                                                    <td>
                                                        <input type="checkbox" class="check-all tr dt-checkboxes">
                                                    </td>
                                                @endif
                                                <th></th>
                                                <th>Name</th>
                                                @developer
                                                    <th>Key</th>
                                                    <th>Action</th>
                                                @enddeveloper
                                            </tr>
                                        </thead>
                                        <tbody class="table-tr-icons">
                                            @foreach ($attributes as $attribute)
                                                <tr  data-sort-id="{{$attribute->id}}">
                                                    @if($bulkSelection)
                                                        <td>
                                                            <input type="checkbox" class="checkable tr dt-checkboxes">
                                                        </td>
                                                    @endif
                                                    <td align="center" class="order-change"><i class="fa fa-fw fa-arrows-alt" data-toggle="tooltip" title="Grag up or down"></i></td>
                                                    <td>{{ $attribute->name }}</td>
                                                    @developer
                                                        <td>{{ $attribute->key }}</td>
                                                        <td width="100px">
                                                            <!-- Dropdown Trigger -->
                                                            <a class='dropdown-trigger' data-target='dropdown{{ $attribute->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                            <!-- Dropdown Structure -->
                                                            <ul id='dropdown{{ $attribute->id }}' class='dropdown-content'>
                                                                <li><a href="{{ url('admin/attribute') }}/{{ $attribute->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
                                                            </ul>
                                                        </td>
                                                    @enddeveloper
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>

                            {{-- Load common Pagination --}}
                            @include('admin.partials.default-table-pagination',[
                                'tblData'   => $attributes,
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
                        <h4 class="dnf-ui-title">Sorry, Attributes List Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
