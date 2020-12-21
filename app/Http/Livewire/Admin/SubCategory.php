<?php

namespace App\Http\Livewire\Admin;

use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\SubCategory as AppSubCategory;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class SubCategory extends Component
{
    use LivewirePagination;

    public $items, $page, $bulkSelection, $categories, $category_id, $status;

    /*
        - Initialize default value
        - mount() work same as __construct()
    */
    public function mount()
    {
        $this->category_id = -1;
        $this->items = 10;
        $this->page = 1;
        $this->status = AppSubCategory::PUBLISH;
        $this->bulkSelection = false; // visible checkbox row level
    }

    public function render(SubCategoryRepositoryInterface $subCategoryInterface, Request $request)
    {
        // change request param
        $request->merge([
            'category_id'   => $this->category_id,
            'items'         => $this->items,
            'page'          => $this->page,
            'status'        => $this->status
        ]);

        // trigger javascript custom event
        $this->dispatchBrowserEvent('jsTrigger');

        return view('livewire.admin.sub-category', [
            'bulkSelection'     => $this->bulkSelection,
            'subCategories'     => $subCategoryInterface->filterWithPaginate()
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

    public function changeStatus($status = AppSubCategory::PUBLISH)
    {
        $this->status = $status;
    }

    public function clearFilter()
    {
        $this->mount();
    }
}
