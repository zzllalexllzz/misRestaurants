<?php

namespace App\Http\Livewire;

use App\Models\Dish;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class OrderDetail extends Component
{
    public $order;
    public $orderId;
    public $client;
    public $total_payment;
    public $total_quantity;
    public Collection $dishes;
    public Order $editing;

    public function rules()
    {
        return [
            'editing.state' => 'required|in:' . collect(Order::STATUSES)->keys()->implode(','),
            'editing.deliveryman_id' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'in' => 'The selected :attribute is invalid.',
            'integer' => 'The :attribute must be an integer.'
        ];
    }

    public function mount(Order $order = null)
    {
        $this->order = $order;
        $this->client = $order->getClient;
        $this->editing = Order::make();
    }
    public function render()
    {
        $this->orderId = $this->order->id;
        $this->order = Order::find($this->orderId)->first();
        $this->dishes = $this->order->getDishes;
        return view('livewire.order-detail');
    }

    public function edit(Order $orderObj)
    {
        if ($this->editing->isNot($orderObj)) $this->editing = $orderObj;
        $this->emit('modalOpen');
    }

    public function deliver(Order $orderObj, $userId)
    {
        $this->editing = $orderObj;
        $this->editing->deliveryman_id = $userId;
        $this->validate($this->rules(), $this->messages());
        $this->editing->save();
    }

    public function save()
    {
        $this->validate($this->rules(), $this->messages());
        $this->editing->save();
        $this->emit('modalSave'); // Close modal using jquery in layout
    }
}
