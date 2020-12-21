@if (count($subScribers) != 0)
    <div class="row">
        <div class="col s12">
            <div class="card fixed-tabs-card">
                <div class="table-tabs-pills">
                    <ul class="nav nav-pills"></ul>
                </div>
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
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody class="table-tr-icons">
                                    @foreach ($subScribers as $subscribe)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>{{$subscribe->email_subscribe}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Load common Pagination --}}
                            @include('admin.partials.default-table-pagination',[
                                'tblData'   => $subScribers,
                                'livewire'  => true
                            ])
                        </div>

                        {{-- Load liveWire Loading --}}
                        @include('admin.partials.wire-loading')
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="card fixed-tabs-card dnf-ui-card">
        <div class="card-content">
            <div class="center-align">
                <img width="40%" src="{{ url('assets/img/dnf-ui.jpg') }}">
                <h4 class="dnf-ui-title">Sorry, Email Subscriber List Not Found</h4>
            </div>
        </div>
    </div>
@endif
