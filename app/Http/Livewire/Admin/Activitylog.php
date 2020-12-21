<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Traits\LivewirePagination;
use Spatie\Activitylog\Models\Activity;

class Activitylog extends Component
{
    use LivewirePagination;

    public $items, $tab, $page, $bulkSelection, $sortField, $sortDirection, $fromDate, $toDate, $isFilter = null;
    public $tabs = [
        ['key' => 'all', 'title'=>'All'],
        ['key' => 'login', 'title'=>'Login'],
        ['key' => 'product', 'title'=>'Product'],
        ['key' => 'coupon', 'title'=>'Coupon'],
        ['key' => 'return', 'title'=>'Return'],
        ['key' => 'inquiry', 'title'=>'Inquiry'],
        ['key' => 'order', 'title'=>'Order'],
        ['key' => 'other', 'title'=>'Other'],
    ];

    /*
        - Initialize default value
        - mount() work same as __construct()
    */
    public function mount(){
        $this->tab              = "all";
        $this->items            = 10;
        $this->page             = 1;
        $this->bulkSelection    = false; // visible checkbox row level
        // default sort
        $this->sortField        = 'created_at';
        $this->sortDirection    = "desc";
        $this->isFilter         = false;
    }

    public function render(Request $request){
        // change request param
        $request->merge([
            'items'             => $this->items,
            'tab'               => $this->tab,
            'page'              => $this->page,
        ]);

        $activityLogs = Activity::when($this->tab != 'all', function ($query){
                            return $query->where('log_name', $this->tab);
                        })
                        ->when($this->fromDate, function ($query){
                            return $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($this->fromDate)));
                        })
                        ->when($this->toDate, function ($query){
                            return $query->whereDate('created_at', '<=',  date('Y-m-d', strtotime($this->toDate)));
                        })
                        ->orderBy($this->sortField, $this->sortDirection)
                        ->paginate();

        // trigger javascript custom event
        $this->dispatchBrowserEvent('jsTrigger');

        return view('livewire.admin.activitylog',[
            'bulkSelection' => $this->bulkSelection,
            'activityLogs'  => $activityLogs,
            'tabs'          => $this->tabs
        ]);
    }

    /* change status(like all, active, block users) */
    public function changeTab($tab = "all"){
        $this->mount();
        $this->tab = $tab;
    }

    public function sort($sortField){
        $this->sortField        = $sortField;
        $this->sortDirection    = ($this->sortDirection == "DESC") ? "ASC" : "DESC";
    }

    /* the updated* method follows your variable name and is camel-cased */
    public function updatedItems(){
        $this->page = 1;
    }

    public function search($formData){
        $this->fromDate = $formData['from_date'];
        $this->toDate   = $formData['to_date'];
        $this->isFilter         = true;
    }

    public function clearDateRange(){
        $this->fromDate = $this->toDate = null;
    }
}
