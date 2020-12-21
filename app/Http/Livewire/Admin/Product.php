<?php

namespace App\Http\Livewire\Admin;

use App\ProductAttribute;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use App\Traits\LivewirePagination;
use App\Traits\LivewireSort;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Product extends Component
{
    use LivewirePagination, LivewireSort;

    public $items, $status, $page, $bulkSelection, $isFilter, $title, $sku, $form_date, $to_date;

    /*
        - Initialize default value
        - mount() work same as __construct()
    */
    public function mount()
    {
        $this->title = $this->sku = $this->form_date = $this->to_date = null;
        $this->items            = 10;
        $this->page             = 1;
        $this->status           = ProductAttribute::PUBLISH;
        $this->bulkSelection    = false; // visible checkbox row level
        $this->isFilter         = false;
        // default sort
        $this->sortField        = 'id';
        $this->sortDirection    = "desc";
    }

    public function render(ProductAttributeRepositoryInterface $productAttribute, ProductRepositoryInterface $product, Request $request)
    {
        // change request param
        $request->merge([
            'title'             => $this->title,
            'sku'               => $this->sku,
            'from_date'         => $this->form_date,
            'to_date'           => $this->to_date,
            'status'            => $this->status,
            'page'              => $this->page,
            'items'             => $this->items,
            'sort_field'        => $this->sortField,
            'sort_direction'    => $this->sortDirection,

        ]);

        // trigger javascript custom event
        $this->dispatchBrowserEvent('jsTrigger');
        return view('livewire.admin.product', [
            'products'          => $productAttribute->filterWithPaginate(),
            'productsStatus'    => $product->findAllStatus(),
            'isFilter'          => $this->isFilter
        ]);
    }

    public function changeStatus($status = -1)
    {
        $this->clearFilter();
        $this->status = $status;
    }


    /* filter using name and email wise */
    public function search($formData)
    {
        $this->title        = $formData['title'];
        $this->sku          = $formData['sku'];
        $this->form_date    = $formData['from_date'];
        $this->to_date      = $formData['to_date'];
        $this->isFilter     = true;
    }

    public function clearFilter()
    {
        $this->mount();
    }

    /* the updated* method follows your variable name and is camel-cased */
    public function updatedItems()
    {
        $items = $this->items;
        $this->clearFilter();
        $this->items  = $items;
    }
}
