<div class="row mt-3">
    <div class="col s1 right-align">
        <select class="form-select" wire:model="items">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>
    <div class="col s3 mt-1">
        <div class="black-text">
            {!! $tblData->currentPage()."-".$tblData->lastPage()." of ".$tblData->total() !!}
        </div>
    </div>
    <div class="col s8 right-align">
        @if( method_exists($tblData,'links'))
            @if($livewire)
                {!! $tblData->appends(request()->input())->links('panels.pagination-livewire') !!}
            @else
                {!! $tblData->appends(request()->input())->links('panels.pagination') !!}
            @endif
        @endif
    </div>
</div>
