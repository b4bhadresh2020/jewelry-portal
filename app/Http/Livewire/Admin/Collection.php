<?php

namespace App\Http\Livewire\Admin;

use App\Repositories\Collection\CollectionRepositoryInterface;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class Collection extends Component
{
    use LivewirePagination;

    public $items, $page, $bulkSelection;

    public function render(CollectionRepositoryInterface $collectionInterface, Request $request)
    {
        $request->merge([
            'items' => $this->items,
            'page'  => $this->page
        ]);

        $this->dispatchBrowserEvent('jsTrigger');

        return view('livewire.admin.collection', [
            'bulkSelection' => $this->bulkSelection,
            'collections'    => $collectionInterface->filterWithPaginate()
        ]);
    }
}
