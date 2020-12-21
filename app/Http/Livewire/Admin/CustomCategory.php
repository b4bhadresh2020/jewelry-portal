<?php

namespace App\Http\Livewire\Admin;

use App\CustomCategory as AppCustomCategory;
use App\Repositories\CustomCategory\CustomCategoryRepositoryInterface;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class CustomCategory extends Component
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
        $this->status = AppCustomCategory::PUBLISH;
        $this->bulkSelection = false; // visible checkbox row level
    }

    public function render(CustomCategoryRepositoryInterface $customCategoryInterface, Request $request)
    {
        // change request param
        $request->merge([
            'items' => $this->items,
            'page'  => $this->page,
            'status' => $this->status
        ]);

        // trigger javascript custom event
        $this->dispatchBrowserEvent('jsTrigger');

        return view('livewire.admin.custom-category', [
            'bulkSelection' => $this->bulkSelection,
            'customCategories'    => $customCategoryInterface->filterWithPaginate()
        ]);
    }

    /* the updated* method follows your variable name and is camel-cased */
    public function updatedItems()
    {
        $items = $this->items;
        $this->mount();
        $this->items  = $items;
    }

    public function changeStatus($status = AppCustomCategory::PUBLISH)
    {
        $this->status = $status;
    }

    public function clearFilter()
    {
        $this->mount();
    }
}