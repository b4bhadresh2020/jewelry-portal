<?php

namespace App\Http\Livewire\Admin;

use App\Repositories\PaymentGateway\PaymentGatewayRepositoryInterface;
use App\Traits\LivewirePagination;
use Illuminate\Http\Request;
use Livewire\Component;

class PaymentGateway extends Component
{
    use LivewirePagination;

    public $items, $page, $bulkSelection;
    public $status;


    public function mount()
    {
        $this->items = 10;
        $this->page = 1;
        $this->status = false;
        $this->bulkSelection = false; // visible checkbox row level
    }

    public function render(PaymentGatewayRepositoryInterface $paymentGateway, Request $request)
    {
        $request->merge([
            'items' => $this->items,
            'page'  => $this->page
        ]);

        $this->dispatchBrowserEvent('jsTrigger');

        return view('livewire.admin.payment-gateway', [
            'bulkSelection' => $this->bulkSelection,
            'paymentGateways'    => $paymentGateway->filterWithPaginate()
        ]);
    }
}