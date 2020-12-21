<?php

namespace App\Http\Livewire\Admin;

use App\Repositories\Subscriber\SubScriberRepositoryInterface;
use App\Traits\LivewirePagination;
use Livewire\Component;
use Illuminate\Http\Request;


class SubScriber extends Component
{
    use LivewirePagination;


    public $items, $page, $bulkSelection;

    public function mount()
    {
        $this->items = 10;
        $this->page = 1;
        $this->bulkSelection = false; // visible checkbox row level
    }

    public function render(SubScriberRepositoryInterface $subScriber,Request $request)
    {
        $request->merge([
            'items' => $this->items,
            'page'  => $this->page
        ]);

        $this->dispatchBrowserEvent('jsTrigger');

        return view('livewire.admin.sub-scriber',['bulkSelection' => $this->bulkSelection,'subScribers'=> $subScriber->filterWithPaginate()]);
    }
}
