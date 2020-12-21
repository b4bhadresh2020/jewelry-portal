<?php

namespace App\Http\Livewire\Admin;

use App\Repositories\FaqCategory\FaqCategoryRepositoryInterface;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class Faqcategory extends Component
{
    use LivewirePagination;

    public $items, $page, $bulkSelection;

    public function mount(){
        $this->items = 10;
        $this->page = 1;
        $this->bulkSelection = false; // visible checkbox row level
    }

    public function render(FaqCategoryRepositoryInterface $faqCategoryInterface, Request $request)
    {
        $request->merge([
            'items' => $this->items,
            'page'  => $this->page
        ]);
        return view('livewire.admin.faqcategory',[
            'bulkSelection' => $this->bulkSelection,
            'faqcategory'    => $faqCategoryInterface->filterWithPaginate()
        ]);
    }
    public function updatedItems()
    {
        $items = $this->items;
        $this->mount();
        $this->items  = $items;
    }
}
