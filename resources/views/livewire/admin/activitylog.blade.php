<div class="row">
    <div class="col s12">
        {{-- Load Filter--}}

        <div class="card">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    @foreach($tabs as $tab)
                        <li class="nav-item">
                            <a class="nav-link pointer @if(request('tab')===$tab['key']) active @endif" wire:click="changeTab('{{$tab['key'] }}')"> {{ $tab['title'] }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="row">
                    <form wire:submit.prevent="search(Object.fromEntries(new FormData($event.target)))">
                        <div class="col m8 special-pad">
                            <div class="row">
                                <div class="col m6 input-field">
                                    <label for="FromDate">From Date</label>
                                    <input name="from_date" id="FromDate" type="text" class="custom-datepicker">
                                </div>

                                <div class="col m6 input-field">
                                    <label for="ToDate">To Date</label>
                                    <input name="to_date" id="ToDate" type="text" class="custom-datepicker">
                                </div>
                            </div>
                        </div>

                        <div class="col bg-green mt-4">
                            <button type="submit" name="search" class="btn"><i class="fa fa-filter" aria-hidden="true"></i></button>
                            <button type="reset"  wire:click='clearDateRange' class="btn"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            @if(count($activityLogs) != 0)
                <div class="card-content">
                    <div class="row" style="position: relative;">

                        <div class="col s12">
                            {{-- create table --}}
                            <table class="common-data-table bordered display striped nowrap">
                                <thead class="common-livewire-header">
                                    <tr>
                                        @if($bulkSelection)
                                            <td>
                                                <input type="checkbox" class="check-all tr dt-checkboxes">
                                            </td>
                                        @endif
                                        <th> Description</th>
                                        <th wire:click="sort('created_at')"> Date
                                            @include('panels.sort-icon',[ 'sort' => 'created_at' ])
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="table-tr-icons">
                                    @foreach ($activityLogs as $activityLog)
                                        <tr>
                                            @if($bulkSelection)
                                                <td>
                                                    <input type="checkbox" class="checkable tr dt-checkboxes">
                                                </td>
                                            @endif
                                            <td>{{ $activityLog->description }}</td>
                                            <td>{{ $activityLog->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Load common Pagination --}}
                            @include('admin.partials.default-table-pagination',[
                                'tblData'   => $activityLogs,
                                'livewire'  => true
                            ])

                            <p class="right-align red-text">Activity log automatically delete after {{ config('activitylog.delete_records_older_than_days', 365) }} days.</p>
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
                            @foreach($tabs as $tab)
                                @if(request('tab')===$tab['key']) {{ $tab['title'] }} @endif
                            @endforeach
                            Activity Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
