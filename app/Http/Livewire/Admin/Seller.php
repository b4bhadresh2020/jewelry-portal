<?php

namespace App\Http\Livewire\Admin;

use App\Seller as AppSeller;
use App\Repositories\Seller\SellerRepositoryInterface;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class Seller extends Component
{
    use LivewirePagination;

    public $items, $page, $bulkSelection, $status;

    /*
        - Initialize default value
        - mount() work same as __construct()
    */
    public function mount()
    {
        $this->items = 10;
        $this->page = 1;
        $this->status = AppSeller::PUBLISH;
        $this->bulkSelection = false; // visible checkbox row level
    }

    public function render(SellerRepositoryInterface $sellerInterface, Request $request)
    {
        // change request param
        $request->merge([
            'items' => $this->items,
            'page'  => $this->page,
            'status' => $this->status
        ]);

        // trigger javascript custom event
        $this->dispatchBrowserEvent('jsTrigger');

        return view('livewire.admin.seller', [
            'bulkSelection' => $this->bulkSelection,
            'sellers'    => $sellerInterface->filterWithPaginate()
        ]);
    }

    /* the updated* method follows your variable name and is camel-cased */
    public function updatedItems()
    {
        $items = $this->items;
        $this->mount();
        $this->items  = $items;
    }
    public function changeStatus($status = AppSeller::PUBLISH)
    {
        $this->status = $status;
    }
}