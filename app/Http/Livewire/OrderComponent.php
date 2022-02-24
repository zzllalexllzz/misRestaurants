<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderComponent extends Component
{
    use WithPagination;

    public $restaurant;
    public $state = 'received';
    public Order $editing;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['changeState'];

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


    // Getting parameters from OrderController
    public function mount($restaurant = "")
    {
        $this->restaurant = $restaurant;
        $this->editing = Order::make();
    }

    public function render()
    {
        if (!empty($this->restaurant)) {
            $orders = Order::where('restaurant_id', $this->restaurant->id)
                ->where('state', $this->state)->orderBy('created_at')->paginate(5);
        } else {
            if (auth()->user()->role->name === 'Deliveryman') {
                $orders = Order::where('state', 'prepared')
                    ->where(function ($query) {
                        $query->where('deliveryman_id', auth()->user()->id)
                            ->orWhere('deliveryman_id', null);
                    })
                    ->orderBy('created_at')->paginate(5);
            } else {
                $orders = Order::orderBy('created_at')->paginate(5);
            }
        }

        return view('livewire.order-component', ['orders' => $orders]);
    }

    // Method emitted from parent component to filter by states
    public function changeState($state)
    {
        $this->state = $state;
    }

    public function edit(Order $order)
    {
        if ($this->editing->isNot($order)) $this->editing = $order;
        $this->emit('modalOpen');
    }

    public function deliver(Order $order, $userId)
    {
        $this->editing = $order;
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
