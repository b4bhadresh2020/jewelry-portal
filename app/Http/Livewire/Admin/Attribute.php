<?php

namespace App\Http\Livewire\Admin;

use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class Attribute extends Component
{
    use LivewirePagination;

    public $items, $page, $bulkSelection;

    /*
        - Initialize default value
        - mount() work same as __construct()
    */
    public function mount()
    {
        $this->items = 10;
        $this->page = 1;
        $this->bulkSelection = false; // visible checkbox row level
    }

    public function render(AttributeRepositoryInterface $attributeInterface, Request $request)
    {
        // change request param
        $request->merge([
            'items' => $this->items,
            'page'  => $this->page
        ]);

        // trigger javascript custom event
        $this->dispatchBrowserEvent('jsTrigger');

        return view('livewire.admin.attribute', [
            'bulkSelection' => $this->bulkSelection,
            'attributes'    => $attributeInterface->filterWithPaginate()
        ]);
    }

    /* the updated* method follows your variable name and is camel-cased */
    public function updatedItems()
    {
        $items = $this->items;
        $this->mount();
        $this->items  = $items;
    }
}
