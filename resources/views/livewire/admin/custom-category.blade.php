<div>
    {{-- The Master doesn't talk, he acts. --}}
</div>
@php
    use App\CustomCategory;
@endphp
<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')=== CustomCategory::PUBLISH || request('status')===null) active @endif" wire:click="changeStatus({{ CustomCategory::PUBLISH }})" ><i class="material-icons left">dehaze</i> Publish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')=== CustomCategory::ARCHIVE) active @endif" wire:click="changeStatus({{ CustomCategory::ARCHIVE }})"><i class="material-icons left">check</i> Archive</a>
                    </li>
                </ul>
                @permission('add-custom-category')
                    <a href="{{ url('admin/custom-category/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>

            @if (count($customCategories) != 0)
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($customCategories as $customCategory)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>{{ $customCategory->name }}</td>
                                            <td width="100px">
                                                <a class='dropdown-trigger' data-target='dropdown{{ $customCategory->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $customCategory->id }}' class='dropdown-content'>\
                                                    @permission('edit-custom-category')
                                                        <li><a href="{{ url('admin/custom-category') }}/{{ $customCategory->id }}/edit">Edit</a></li>
                                                    @endpermission

                                                    @if ($customCategory->status == CustomCategory::ARCHIVE)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/custom-category//'.$customCategory->id.'/change-status/'.CustomCategory::PUBLISH) }}"
                                                                data-title="Moved To Publish"
                                                                data-content="Are you sure you want to publish this custom category?"
                                                                class="common-normal-link-confirmation"> Moved To Publish
                                                            </a>
                                                        </li>
                                                    @elseif($customCategory->status == CustomCategory::PUBLISH)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/custom-category/'.$customCategory->id.'/change-status/'.CustomCategory::ARCHIVE) }}"
                                                                data-title="Moved To Archive Confirmation!"
                                                                data-content="Are you sure you want to archive this custom category?"
                                                                class="common-normal-link-confirmation"> Moved To Archive
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" onclick="copyClipbord('{{ url('custom-category') }}/{{ $customCategory->slug }}');">
                                                               Copy Url
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
                                'tblData'   => $customCategories,
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
                        <h4 class="dnf-ui-title">Sorry, Custom Category List Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
