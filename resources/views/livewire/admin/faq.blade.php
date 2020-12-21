<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                @permission('add-faq-information')
                    <a href="{{ url('admin/faq/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>
            @if (count($faqs) != 0)
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
                                        <th>FaqCategory</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        @anypermission('edit-faq-information','delete-faq-information')
                                            <th>Action</th>
                                        @endanypermission
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                @foreach($faqs as $faq)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>{{ $faq->faqCategory->name }}</td>
                                            <td>{{ $faq->question}}</td>
                                            <td>{!! $faq->answer !!}</td>
                                            @anypermission('edit-faq-information','delete-faq-information')
                                                <td width="100px">
                                                    <a class='dropdown-trigger' data-target='dropdown{{ $faq->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                    <ul id='dropdown{{ $faq->id }}' class='dropdown-content'>
                                                        @permission('edit-faq-information')
                                                            <li><a href="{{ url('admin/faq') }}/{{ $faq->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
                                                        @endpermission
                                                        @permission('delete-faq-information')
                                                            <li>
                                                                <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/faq/'.$faq->id) }}" data-title="Delete Faq information Confirmation!" data-content="Are you sure you want to delete this faq information?" class="common-remove-popup">
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
                                'tblData'   => $faqs,
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
                        <h4 class="dnf-ui-title">Sorry, Faq Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
