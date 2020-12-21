@php
    use App\Category;
@endphp
<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')=== Category::PUBLISH || request('status')===null) active @endif" wire:click="changeStatus({{ Category::PUBLISH }})" ><i class="material-icons left">dehaze</i> Publish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')=== Category::ARCHIVE) active @endif" wire:click="changeStatus({{ Category::ARCHIVE }})"><i class="material-icons left">check</i> Archive</a>
                    </li>
                </ul>
                @permission('add-category')
                    <a href="{{ url('admin/category/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>

            @if (count($categories) != 0)
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
                                        <th>Banner Image</th>
                                        <th>Offer Image</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($categories as $category)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td width="150px">
                                                <img class="img-zoom-2" src="@if(!empty($category->categoryImage->first())){{getMediaUrlToMedia($category->categoryImage->first()->media->first())}}  @else {{getMediaUrlToMedia($category->media)}} @endif" height="100px" width="80px">
                                            </td>
                                            <td width="150px">
                                                <img class="img-zoom-2" src="@if(!empty($category->bannerImage->first())){{getMediaUrlToMedia($category->bannerImage->first()->media->first())}}  @else {{getMediaUrlToMedia($category->media)}} @endif" height="100px" width="80px">
                                            </td>
                                            <td width="150px">
                                                <img class="img-zoom-2" src="@if(!empty($category->offerImage->first())){{getMediaUrlToMedia($category->offerImage->first()->media->first())}}  @else {{getMediaUrlToMedia($category->media)}} @endif"  height="100px" width="80px">
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td width="100px">
                                                <a class='dropdown-trigger' data-target='dropdown{{ $category->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $category->id }}' class='dropdown-content'>
                                                    @permission('edit-category')
                                                        <li><a href="{{ url('admin/category') }}/{{ $category->id }}/edit">Edit</a></li>
                                                    @endpermission

                                                    @if ($category->status == Category::ARCHIVE)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/category/'.$category->id.'/change-status/'.Category::PUBLISH) }}"
                                                                data-title="Moved To Publish"
                                                                data-content="Are you sure you want to publish this category?"
                                                                class="common-normal-link-confirmation"> Moved To Publish
                                                            </a>
                                                        </li>
                                                    @elseif($category->status == Category::PUBLISH)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/category/'.$category->id.'/change-status/'.Category::ARCHIVE) }}"
                                                                data-title="Moved To Archive Confirmation!"
                                                                data-content="Are you sure you want to archive this category?"
                                                                class="common-normal-link-confirmation"> Moved To Archive
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" onclick="copyClipbord('{{ url('category') }}/{{ $category->slug }}');">
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
                                'tblData'   => $categories,
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
                        <h4 class="dnf-ui-title">Sorry, Category List Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
