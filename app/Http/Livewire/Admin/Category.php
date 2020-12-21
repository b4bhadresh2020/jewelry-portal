<?php

namespace App\Http\Livewire\Admin;

use App\Category as AppCategory;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class Category extends Component
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
        $this->status = AppCategory::ARCHIVE;
        $this->bulkSelection = false; // visible checkbox row level
    }

    public function render(CategoryRepositoryInterface $categoryInterface, Request $request)
    {
        // change request param
        $request->merge([
            'items' => $this->items,
            'page'  => $this->page,
            'status' => $this->status
        ]);

        // trigger javascript custom event
        $this->dispatchBrowserEvent('jsTrigger');

        return view('livewire.admin.category', [
            'bulkSelection' => $this->bulkSelection,
            'categories'    => $categoryInterface->filterWithPaginate()
        ]);
    }

    /* the updated* method follows your variable name and is camel-cased */
    public function updatedItems()
    {
        $items = $this->items;
        $this->mount();
        $this->items  = $items;
    }

    public function changeStatus($status = AppCategory::ARCHIVE)
    {
        $this->status = $status;
    }

    public function clearFilter()
    {
        $this->mount();
    }
}