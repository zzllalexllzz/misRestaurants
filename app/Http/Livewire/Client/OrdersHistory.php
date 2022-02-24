<?php

namespace App\Http\Livewire\Client;

use App\Http\Controllers\InvoiceController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class OrdersHistory extends Component
{
    public $orders;
    public $client;

    public function mount()
    {
        $this->client = auth()->user();
        $this->orders = $this->client->getOrders->sortByDesc('created_at');
    }


    public function render()
    {
        return view('livewire.client.orders-history');
    }
}
