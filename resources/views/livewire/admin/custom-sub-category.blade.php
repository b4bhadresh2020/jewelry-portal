@php
    use App\CustomSubCategory;
@endphp
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')=== CustomSubCategory::PUBLISH || request('status')===null) active @endif" wire:click="changeStatus(1)" ><i class="material-icons left">dehaze</i> Publish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')=== CustomSubCategory::ARCHIVE) active @endif" wire:click="changeStatus(2)"><i class="material-icons left">check</i> Archive</a>
                    </li>
                </ul>

                @if(count($customSubCategories) != 0 || count($this->customCategories) != 0)
                    <div class="input-field1 col m4">
                        <select wire:model="custom_category_id" class="browser-default" name="custom_category_id" id="custom_category_id">
                            <option value="-1" selected>All Category</option>
                            @foreach ($this->customCategories as $item)
                                <option @if(old('custom_category_id')==$item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @permission('add-custom-sub-category')
                    <a href="{{  url('admin/custom-sub-category/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>

            @if(count($customSubCategories) != 0)
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <table class="display nowrap scroll_vert_hor">
                                <thead>
                                    <tr>
                                        @if($bulkSelection)
                                            <td>
                                                <input type="checkbox" class="check-all tr dt-checkboxes">
                                            </td>
                                        @endif
                                        <th>Category</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($customSubCategories as $customSubCategory)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>{{ $customSubCategory->customCategory->name }}</td>
                                            <td>{{ $customSubCategory->content }}</td>
                                            <td width="100px">
                                                <a class='dropdown-trigger' data-target='dropdown{{ $customSubCategory->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $customSubCategory->id }}' class='dropdown-content'>
                                                    @permission('edit-custom-sub-category')
                                                        <li><a href="{{ url('admin/custom-sub-category') }}/{{ $customSubCategory->id }}/edit">Edit</a></li>
                                                    @endpermission

                                                    @if ($customSubCategory->status == CustomSubCategory::ARCHIVE)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/custom-sub-category/'.$customSubCategory->id.'/change-status/'.CustomSubCategory::PUBLISH) }}"
                                                                data-title="Moved To Publish"
                                                                data-content="Are you sure you want to publish this custom subCategory?"
                                                                class="common-normal-link-confirmation"> Moved To Publish
                                                            </a>
                                                        </li>
                                                    @elseif($customSubCategory->status == CustomSubCategory::PUBLISH)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/custom-sub-category/'.$customSubCategory->id.'/change-status/'.CustomSubCategory::ARCHIVE) }}"
                                                                data-title="Moved To Archive Confirmation!"
                                                                data-content="Are you sure you want to archive this custom subCategory?"
                                                                class="common-normal-link-confirmation"> Moved To Archive
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" onclick="copyClipbord('{{ url('custom-sub-category') }}/{{ $customSubCategory->slug }}/{{ $customSubCategory->slug }}');">
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
                                'tblData' => $customSubCategories,
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
                        <h4 class="dnf-ui-title">Sorry, Custom Sub Category List Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
