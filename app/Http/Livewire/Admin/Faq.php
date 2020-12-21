<?php

namespace App\Http\Livewire\Admin;
use App\Repositories\Faq\FaqRepositoryInterface;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class Faq extends Component
{
    use LivewirePagination;

    public $items, $page, $bulkSelection;

    public function mount(){
        $this->items = 10;
        $this->page = 1;
        $this->bulkSelection = false; // visible checkbox row level
    }

    public function render(FaqRepositoryInterface $faqInterface, Request $request)
    {
        return view('livewire.admin.faq',[
            'bulkSelection' => $this->bulkSelection,
            'faqs'    => $faqInterface->filterWithPaginate()
        ]);
    }
}
