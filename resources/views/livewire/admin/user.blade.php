<div class="row">
    <div class="col s12">
        {{-- Load Filter--}}
        @include('admin.account.filter')

        <div class="card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')===-1 || request('status')===null) active @endif" wire:click="changeStatus()" ><i class="material-icons left">dehaze</i> All User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')===1) active @endif" wire:click="changeStatus(1)"><i class="material-icons left">check</i> Active User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')===0) active @endif" wire:click="changeStatus(0)"><i class="material-icons left">do_not_disturb</i> Block User</a>
                    </li>
                </ul>
                @permission("add-user")
                    <a href="{{  url('admin/account/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>

            @if(count($users) != 0)
                <div class="card-content">
                    <div class="row" style="position: relative;">
                        <div class="col s12">
                            {{-- create table --}}
                            <table class="common-data-table bordered display striped nowrap">
                                <thead class="common-livewire-header">
                                    <tr>
                                        @if($this->bulkSelection)
                                            <td>
                                                <input type="checkbox" class="check-all tr dt-checkboxes">
                                            </td>
                                        @endif
                                        <th wire:click="sort('first_name')">First Name
                                            @include('panels.sort-icon',[ 'sort' => 'first_name' ])
                                        </th>
                                        <th wire:click="sort('last_name')">Last Name
                                            @include('panels.sort-icon',[ 'sort' => 'last_name' ])
                                        </th>
                                        <th wire:click="sort('phone')">Phone
                                            @include('panels.sort-icon',[ 'sort' => 'phone' ])
                                        </th>
                                        <th wire:click="sort('email')">E-mail
                                            @include('panels.sort-icon',[ 'sort' => 'email' ])
                                        </th>
                                        <th width="100px">Status</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="table-tr-icons">
                                    @foreach ($users as $user)
                                        <tr>
                                            @if($this->bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->email }}</td>
                                            @if ($user->status==1)
                                                <td> <span class="chip green lighten-5"><span class="green-text">Active</span></span></td>
                                            @else
                                                <td> <span class="chip red lighten-5"><span class="red-text">Block</span></span></td>
                                            @endif
                                            <td>
                                                <a class='dropdown-trigger' data-target='dropdown{{ $user->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $user->id }}' class='dropdown-content'>
                                                    @permission('edit-user')
                                                        <li>
                                                            <a href="{{ url('admin/account') }}/{{ $user->id }}/edit"><i class="material-icons">edit</i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                    @endpermission
                                                    {{-- @if($user->id != 1)
                                                        <li>
                                                            <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/account/'.$user->id) }}" data-title="Delete User Confirmation!" data-content="Are you sure you want to delete this user?" class="common-remove-popup">
                                                                <i class="material-icons">delete</i> Delete
                                                            </a>
                                                        </li>
                                                    @endif --}}
                                                    @if($user->status == 1 && $user->id != 1)
                                                        <li>
                                                            <a data-url="{{ url('admin/account/status/'.$user->id."/0") }}" data-title="Block User Confirmation!" data-content="Are you sure you want to block this user?" class="common-normal-link-confirmation">
                                                                <i class="material-icons">do_not_disturb</i> Block
                                                            </a>
                                                        </li>
                                                    @elseif($user->id != 1)
                                                        <li>
                                                            <a data-url="{{ url('admin/account/status/'.$user->id."/1") }}" data-title="Active User Confirmation!" data-content="Are you sure you want to active this user?" class="common-normal-link-confirmation">
                                                                <i class="material-icons">check</i> Active
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Load common Pagination --}}
                            @include('admin.partials.default-table-pagination',[
                                'tblData' => $users,
                                'livewire' => true
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
                        <h4 class="dnf-ui-title">Sorry, @if(request('status')===-1 || request('status')===null) All @elseif(request('status')===1) Active @elseif(request('status')===0) Block @endif User Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
