<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                @permission('add-faq-category')
                    <a href="{{ url('admin/faq-category/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>
            @if (count($faqcategory) != 0)
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
                                        @anypermission('edit-faq-category','delete-faq-category')
                                            <th>Action</th>
                                        @endanypermission
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach($faqcategory as $faq)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>{{ $faq->name }}</td>
                                            @anypermission('edit-faq-category','delete-faq-category')
                                                <td width="100px">
                                                    <a class='dropdown-trigger' data-target='dropdown{{ $faq->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                    <ul id='dropdown{{ $faq->id }}' class='dropdown-content'>
                                                        @permission('edit-faq-category')
                                                            <li><a href="{{ url('admin/faq-category') }}/{{ $faq->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
                                                        @endpermission
                                                        @permission('delete-faq-category')
                                                            <li>
                                                                <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/faq-category/'.$faq->id) }}" data-title="Delete FaqCategory Confirmation!" data-content="Are you sure you want to delete this faq category?" class="common-remove-popup">
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
                                'tblData'   => $faqcategory,
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
                        <h4 class="dnf-ui-title">Sorry, Faq Category Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
