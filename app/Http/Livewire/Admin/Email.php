<?php

namespace App\Http\Livewire\Admin;

use App\Repositories\Email\EmailTemplateRepositoryInterface;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class Email extends Component
{
    use LivewirePagination;

    public $items, $page, $bulkSelection;

    public function mount(){
        $this->items = 10;
        $this->page = 1;
        $this->bulkSelection = false; // visible checkbox row level
    }

    
    public function render(EmailTemplateRepositoryInterface $emailInterface,Request $request)
    {
        $request->merge([
            'items' => $this->items,
            'page'  => $this->page
        ]);
        
        $this->dispatchBrowserEvent('jsTrigger');
            
        return view('livewire.admin.email',[
            'bulkSelection' => $this->bulkSelection,
            'emailTemplates'       => $emailInterface->getFilterWithPaginate()
        ]);
    }
 
}
