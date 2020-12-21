<?php

namespace App\Http\Livewire\Admin;

use App\Discount as AppDiscount;
use Livewire\Component;
use App\Repositories\Discount\DiscountRepositoryInterface;
use Illuminate\Http\Request;
use  App\Traits\LivewirePagination;

class Discount extends Component
{
    use LivewirePagination;

    public $couponCode, $offer, $fromDate, $toDate, $discount, $items, $redeemLimit, $status, $page, $bulkSelection, $sortField, $sortDirection, $isFilter;

    /*
        - Initialize default value
        - mount() work same as __construct()
    */
    public function mount()
    {
        $this->couponCode       = null;
        $this->offer            = null;
        $this->fromDate         = null;
        $this->toDate           = null;
        $this->discount         = null;
        $this->redeemLimit      = null;
        $this->items            = 10;
        $this->page             = 1;
        $this->bulkSelection    = false; // visible checkbox row level
        $this->sortField        = 'discounts.id'; // default sort
        $this->sortDirection    = "desc";
        $this->isFilter         = false;
        $this->status           = AppDiscount::ALL;
    }

    public function render(DiscountRepositoryInterface $discountInterface, Request $request)
    {

        // change request param
        if ($this->couponCode != null) {
            $request->merge([
                'coupon_code'       => $this->couponCode,
            ]);
        }
        $request->merge([
            'items'             => $this->items,
            'offer'             => $this->offer,
            'from_date'          => $this->fromDate,
            'to_date'           => $this->toDate,
            'discount'            => $this->discount,
            'redeem_limit'      => $this->redeemLimit,
            'status'            => $this->status,
            'page'              => $this->page,
            'sort_field'        => $this->sortField,
            'sort_direction'    => $this->sortDirection,
        ]);
        // trigger javascript custom event
        $this->dispatchBrowserEvent('jsTrigger');
        return view('livewire.admin.discount', [
            'bulkSelection' => $this->bulkSelection,
            'discounts'         => $discountInterface->filterWithPaginate()
        ]);
    }

    /* change status(like all, active, block users) */
    public function changeStatus($status = AppDiscount::ALL)
    {
        $this->clearFilter();
        $this->status   = $status;
    }

    /* filter using name and email wise */
    public function search($formData)
    {
        $this->couponCode     = $formData['coupon_code'];
        $this->offer           = $formData['offer'];
        $this->fromDate       = $formData['from_date'];
        $this->toDate         = $formData['to_date'];
        $this->discount        = $formData['discount'];
        $this->redeemLimit    = $formData['redeem_limit'];
        $this->isFilter         = true;
    }

    public function clearFilter()
    {
        $this->mount();
    }

    public function sort($sortField)
    {
        $this->sortField        = $sortField;
        $this->sortDirection    = ($this->sortDirection == "DESC") ? "ASC" : "DESC";
    }

    /* the updated* method follows your variable name and is camel-cased */
    public function updatedItems()
    {
        $items = $this->items;
        $this->clearFilter();
        $this->items  = $items;
    }
}
