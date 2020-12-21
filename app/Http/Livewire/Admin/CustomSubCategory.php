<?php

namespace App\Http\Livewire\Admin;

use App\Repositories\CustomSubCategory\CustomSubCategoryRepositoryInterface;
use App\CustomSubCategory as AppCustomSubCategory;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class CustomSubCategory extends Component
{
    use LivewirePagination;

    public $items, $page, $bulkSelection, $customCategories, $custom_category_id, $status;

    /*
        - Initialize default value
        - mount() work same as __construct()
    */
    public function mount()
    {
        $this->custom_category_id = -1;
        $this->items = 10;
        $this->page = 1;
        $this->status = AppCustomSubCategory::PUBLISH;
        $this->bulkSelection = false; // visible checkbox row level
    }

    public function render(CustomSubCategoryRepositoryInterface $customSubCategoryInterface, Request $request)
    {
        // change request param
        $request->merge([
            'custom_category_id'   => $this->custom_category_id,
            'items'         => $this->items,
            'page'          => $this->page,
            'status'        => $this->status
        ]);

        // trigger javascript custom event
        $this->dispatchBrowserEvent('jsTrigger');

        return view('livewire.admin.custom-sub-category', [
            'bulkSelection'     => $this->bulkSelection,
            'customSubCategories'     => $customSubCategoryInterface->filterWithPaginate()
        ]);
    }

    /* the updated* method follows your variable name and is camel-cased */
    public function updatedItems()
    {
        $items = $this->items;
        $this->clearFilter();
        $this->items  = $items;
    }

    public function updatedCategoryId()
    {
        $this->page = 1;
    }

    public function changeStatus($status = AppCustomSubCategory::PUBLISH)
    {
        $this->status = $status;
    }

    public function clearFilter()
    {
        $this->mount();
    }
}