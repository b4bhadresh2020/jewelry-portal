<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Repositories\Inquiry\InquiryProductRepositoryInterface;
use  App\Traits\LivewirePagination;
use Illuminate\Http\Request;

class ProductInquiry extends Component
{
    use LivewirePagination;

    public $name, $items, $toDate, $fromDate, $email, $phone_number, $status, $page, $bulkSelection, $sortField, $sortDirection, $inquiryId, $inquiryContact, $defaultValue, $message, $reply, $selected_id, $isFilter;
    public $viewMessageStatus;

    protected $listeners = ['viewMessage'];


    public function mount()
    {
        $this->name             = null;
        $this->email            = null;
        $this->items            = 10;
        $this->page             = 1;
        $this->bulkSelection    = false; // visible checkbox row level
        // default sort
        $this->sortField        = 'id';
        $this->sortDirection    = "desc";
        $this->inquiryId        = null;
        $this->viewMessageStatus = false;
        $this->toDate = null;
        $this->fromDate = null;
        $this->phone_number = null;
        $this->isFilter         = false;
    }

    public function render(InquiryProductRepositoryInterface $inquiryInterface, Request $request)
    {
        $request->merge([
            'inquiryId'         => $this->inquiryId,
            'items'             => $this->items,
            'email'             => $this->email,
            'name'              => $this->name,
            'to_date'           => $this->toDate,
            'from_date'         => $this->fromDate,
            'phone_number'      => $this->phone_number,
            'status'            => $this->status,
            'page'              => $this->page,
            'sort_field'        => $this->sortField,
            'sort_direction'    => $this->sortDirection,

        ]);
        $this->dispatchBrowserEvent('jsTrigger', [
            'viewMessageStatus'   => $this->viewMessageStatus
        ]);
        $this->viewMessageStatus = false;

        return view('livewire.admin.product-inquiry', [
            'bulkSelection'     => $this->bulkSelection,
            'inquiryInterface'  => $inquiryInterface->filterWithPaginate(),
        ]);
    }

    public function search($formData)
    {
        $this->name     = $formData['name'];
        $this->email    = $formData['email'];
        $this->fromDate    = $formData['from_date'];
        $this->toDate    = $formData['to_date'];
        $this->phone_number    = $formData['phone_number'];
        $this->isFilter         = true;
    }

    public function clearFilter()
    {
        $this->mount();
    }

    public function viewMessage($inquiryId, InquiryProductRepositoryInterface $inquiryInterface)
    {
        $this->clearFilter();
        $inquiryContact             = $inquiryInterface->findById($inquiryId);
        $this->defaultValue = 1;
        $this->inquiryContact       = $inquiryContact;
        $this->viewMessageStatus    = true;
    }

    public function replyInquiry($inquiryId, InquiryProductRepositoryInterface $inquiryInterface)
    {
        $this->defaultValue = 0;
        $inquiryContact             = $inquiryInterface->findById($inquiryId);
        $this->inquiryContact       = $inquiryContact;
        // $this->selected_id = $inquiryContact->id;
        // $this->message = $inquiryContact->message;
        // $this->reply = $inquiryContact->reply;
        $this->viewMessageStatus    = true;
    }

    public function changeStatus($status = -1)
    {
        $this->clearFilter();
        $this->status   = $status;
    }

    public function sort($sortField)
    {
        $this->sortField        = $sortField;
        $this->sortDirection    = ($this->sortDirection == "DESC") ? "ASC" : "DESC";
    }

    public function updatedItems()
    {
        $items = $this->items;
        $this->clearFilter();
        $this->items  = $items;
    }
}
