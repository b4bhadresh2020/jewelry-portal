@php
    use App\SubCategory;
@endphp
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')=== SubCategory::PUBLISH || request('status')===null) active @endif" wire:click="changeStatus(1)" ><i class="material-icons left">dehaze</i> Publish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')=== SubCategory::ARCHIVE) active @endif" wire:click="changeStatus(2)"><i class="material-icons left">check</i> Archive</a>
                    </li>
                </ul>

                @if(count($subCategories) != 0 || count($this->categories) != 0)
                    <div class="input-field1 col m4">
                        <select wire:model="category_id" class="browser-default" name="category_id" id="category">
                            <option value="-1" selected>All Category</option>
                            @foreach ($this->categories as $item)
                                <option @if(old('category_id')==$item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @permission('add-sub-category')
                    <a href="{{  url('admin/sub-category/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>

            @if(count($subCategories) != 0)
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
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($subCategories as $subCategory)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td width="150px"><img  class="img-zoom-2" src="{{ @getMediaUrlToMedia($subCategory->media) }}" height="100px" width="80px"></td>
                                            <td>{{ $subCategory->category->name }}</td>
                                            <td>{{ $subCategory->name }}</td>
                                            <td width="100px">
                                                <a class='dropdown-trigger' data-target='dropdown{{ $subCategory->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $subCategory->id }}' class='dropdown-content'>
                                                    @permission('edit-sub-category')
                                                        <li><a href="{{ url('admin/sub-category') }}/{{ $subCategory->id }}/edit">Edit</a></li>
                                                    @endpermission

                                                    @if ($subCategory->status == SubCategory::ARCHIVE)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/sub-category/'.$subCategory->id.'/change-status/'.SubCategory::PUBLISH) }}"
                                                                data-title="Moved To Publish"
                                                                data-content="Are you sure you want to publish this subCategory?"
                                                                class="common-normal-link-confirmation"> Moved To Publish
                                                            </a>
                                                        </li>
                                                    @elseif($subCategory->status == SubCategory::PUBLISH)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/sub-category/'.$subCategory->id.'/change-status/'.SubCategory::ARCHIVE) }}"
                                                                data-title="Moved To Archive Confirmation!"
                                                                data-content="Are you sure you want to archive this subCategory?"
                                                                class="common-normal-link-confirmation"> Moved To Archive
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" onclick="copyClipbord('{{ url('product') }}/{{ $subCategory->slug }}/{{ $subCategory->slug }}');">
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
                                'tblData' => $subCategories,
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
                        <h4 class="dnf-ui-title">Sorry, Sub Category List Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
