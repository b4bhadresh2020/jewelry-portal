@php
    use App\Seller;
@endphp
<div class="row">
    <div class="col s12">
        <div class="card fixed-tabs-card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')=== Seller::PUBLISH || request('status')===null) active @endif" wire:click="changeStatus({{ Seller::PUBLISH }})" ><i class="material-icons left">dehaze</i> Publish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pointer @if(request('status')=== Seller::ARCHIVE) active @endif" wire:click="changeStatus({{ Seller::ARCHIVE }})"><i class="material-icons left">check</i> Archive</a>
                    </li>
                </ul>
                <a href="{{ url('admin/seller/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                    <i class="material-icons left">add</i> Add New
                </a>
            </div>

            @if (count($sellers) != 0)
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
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($sellers as $seller)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td width="150px"><img class="img-zoom-2" src="{{ @getMediaUrlToMedia($seller->media) }}" height="100px" width="80px"></td>
                                            <td>{{ $seller->title }}</td>
                                            <td>{{ $seller->subtitle }}</td>
                                            <td width="100px">
                                                <a class='dropdown-trigger' data-target='dropdown{{ $seller->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $seller->id }}' class='dropdown-content'>
                                                    <li><a href="{{ url('admin/seller') }}/{{ $seller->id }}/edit">Edit</a></li>

                                                    @if ($seller->status == Seller::ARCHIVE)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/seller/'.$seller->id.'/change-status/'.Seller::PUBLISH) }}"
                                                                data-title="Moved To Publish"
                                                                data-content="Are you sure you want to publish this seller?"
                                                                class="common-normal-link-confirmation"> Moved To Publish
                                                            </a>
                                                        </li>
                                                    @elseif($seller->status == Seller::PUBLISH)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/seller/'.$seller->id.'/change-status/'.Seller::ARCHIVE) }}"
                                                                data-title="Moved To Archive Confirmation!"
                                                                data-content="Are you sure you want to archive this seller?"
                                                                class="common-normal-link-confirmation"> Moved To Archive
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
                                'tblData'   => $sellers,
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
                        <h4 class="dnf-ui-title">Sorry, Seller List Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
