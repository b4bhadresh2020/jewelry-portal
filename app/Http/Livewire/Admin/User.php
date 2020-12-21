<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use  App\Traits\LivewirePagination;
use App\Traits\LivewireSort;

class User extends Component
{
    use LivewirePagination, LivewireSort;

    public $first_name, $last_name, $phone, $email, $items, $status, $page, $bulkSelection, $isFilter;

    /*
        - Initialize default value
        - mount() work same as __construct()
    */
    public function mount()
    {
        $this->first_name = $this->last_name = $this->phone = $this->email  = null;
        $this->items            = 10;
        $this->page             = 1;
        $this->bulkSelection    = false; // visible checkbox row level
        // default sort
        $this->sortField        = 'id';
        $this->sortDirection    = "desc";
        $this->isFilter         = false;
    }

    public function render(UserRepositoryInterface $userInterface, Request $request)
    {
        // change request param
        $request->merge([
            'type'              => 1,
            'items'             => $this->items,
            'email'             => $this->email,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'phone'             => $this->phone,
            'status'            => $this->status,
            'page'              => $this->page,
            'sort_field'        => $this->sortField,
            'sort_direction'    => $this->sortDirection,
        ]);

        // trigger javascript custom event
        $this->dispatchBrowserEvent('jsTrigger');
        return view('livewire.admin.user', [
            'users'         => $userInterface->filterWithPaginate()
        ]);
    }

    /* change status(like all, active, block users) */
    public function changeStatus($status = -1)
    {
        $this->clearFilter();
        $this->status = $status;
    }

    /* filter using name and email wise */
    public function search($formData)
    {
        $this->first_name   = $formData['first_name'];
        $this->last_name    = $formData['last_name'];
        $this->phone        = $formData['phone'];
        $this->email        = $formData['email'];
        $this->isFilter         = true;
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
