@php
    use App\ProductAttribute;
@endphp
<div class="row">
    <div class="col s12">
        {{-- Load Filter--}}
        @include('admin.product.filter', ['status' => request('status'), 'isFilter' => $isFilter])

        <div class="card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    @foreach ($productsStatus as $status)
                        <li class="nav-item">
                            <a class="nav-link pointer @if(request('status')===$status->id) active @endif" wire:click="changeStatus({{ $status->id }})"> {{ $status->name }}</a>
                        </li>
                    @endforeach
                </ul>
                @permission('add-product')
                    <a href="{{  url('admin/product/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>

            @if(count($products) != 0)
                <div class="card-content">
                    <div class="row" style="position: relative;">

                        <div class="col s12">
                            {{-- create table --}}
                            <table class="common-data-table bordered display striped nowrap">
                                <thead class="common-livewire-header">
                                    <tr>
                                        @if($this->bulkSelection)
                                            <th>
                                                <input type="checkbox" class="check-all tr dt-checkboxes">
                                            </th>
                                        @endif
                                        <th>Images</th>
                                        <th>Title</th>
                                        <th>Design No</th>
                                        <th wire:click="sort('created_at')">Created Date
                                            @include('panels.sort-icon',[ 'sort' => 'created_at' ])
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody class="table-tr-icons">
                                    @foreach($products as $product)
                                        <tr>
                                            @if($this->bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td width="150px"><img class="img-zoom-2" src="{{ @getMediaUrlToMedia($product->defaultImage->media[0]) }}" height="100px" width="80px"></td>
                                            <td>{{ (isset($product->product))?$product->product->title : $product->title  }}</td>

                                            <td>{{ (isset($product->sku)) ? $product->sku : '-' }}</td>
                                            <td>{{  $product->created_at }}</td>
                                            <td>
                                                <a class='dropdown-trigger' data-target='dropdown{{ $product->id }}'><i class="material-icons dp48">more_vert</i></a>
                                                <ul id='dropdown{{ $product->id }}' class='dropdown-content'>
                                                    @permission('edit-product')
                                                        <li><a href="{{ url('admin/product') }}/{{ (isset($product->product))?$product->product->id : $product->id }}/edit"> Edit</a></li>
                                                    @endpermission

                                                    @if ($product->status_id == ProductAttribute::ARCHIVE)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/product/attribute/'.$product->id.'/status/'.ProductAttribute::PUBLISH) }}"
                                                                data-title="Moved To Publish"
                                                                data-content="Are you sure you want to publish this product?"
                                                                class="common-normal-link-confirmation"> Moved To Publish
                                                            </a>
                                                        </li>
                                                    @elseif($product->status_id == ProductAttribute::PUBLISH)
                                                        <li>
                                                            <a
                                                                data-csrf="{{ csrf_token() }}"
                                                                data-url="{{ url('admin/product/attribute/'.$product->id.'/status/'.ProductAttribute::ARCHIVE) }}"
                                                                data-title="Moved To Archive Confirmation!"
                                                                data-content="Are you sure you want to archive this product?"
                                                                class="common-normal-link-confirmation"> Moved To Archive
                                                            </a>
                                                        </li>
                                                        <li>
                                                            @php
                                                                $url = ($product->is_default)?$product->product->slug:$product->product->slug.'/'.$product->sku;
                                                            @endphp
                                                            <a href="javascript:void(0);" onclick="copyClipbord('{{ url('product') }}/{{ $url }}')">
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
                                'tblData' => $products,
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
                        <h4 class="dnf-ui-title">Sorry,
                            @foreach($productsStatus as $status)
                                @if(request('status')===$status->id) {{ $status->name }} @endif
                            @endforeach
                             Product Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
