<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills"></ul>
                @permission('add-email-template')
                    <a href="{{ url('admin/email/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>
            @if(count($emailTemplates) != 0)
                <div class="card-content">
                    <div class="row" style="position: relative;">
                        <table class="display nowrap scroll_vert_hor">
                            <thead>
                                <tr>
                                    @if($bulkSelection)
                                    <td>
                                        <input type="checkbox" class="check-all dt-checkboxes">
                                    </td>
                                    @endif
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <!-- <th>Content</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-tr-icons">
                                @foreach ($emailTemplates as $email)
                                <tr>
                                    @if($bulkSelection)
                                    <td>
                                        <input type="checkbox" class="checkable dt-checkboxes">
                                    </td>
                                    @endif
                                    <td width="150px">{{ $email->name }}</td>
                                    <td>{{ $email->subject }}</td>
                                    <!-- <td>{!! $email->content !!}</td> -->
                                    <td width="100px">
                                        <a class='dropdown-trigger' data-target='dropdown{{ $email->id }}'><i
                                                class="material-icons dp48">more_vert</i></a>
                                        <ul id='dropdown{{ $email->id }}'  onclick="showdModal('{{$email->id}}')" class='dropdown-content'>
                                            @permission('view-group')
                                                <li><a href="{{ url('admin/email') }}/{{ $email->id }}/edit"><i class="material-icons">edit</i> Edit</a></li>
                                            @endpermission
                                            {{-- <li>
                                                <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/email/'.$email->id) }}" data-title="Delete Account Confirmation!" data-content="Are you sure you want to delete this email templates?" class="common-remove-popup">
                                                    <i class="material-icons">delete</i> Delete
                                                </a>
                                            </li> --}}
                                            <li> <a class="modal-trigger" href="#modal1"><i class="material-icons dp48">visibility</i> View</a></li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            @else
                <div class="dnf-ui-card">
                    <div class="center-align">
                        <img width="40%" src="{{ url('assets/img/dnf-ui.jpg') }}">
                        <h4 class="dnf-ui-title">Sorry, Email Templates Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
