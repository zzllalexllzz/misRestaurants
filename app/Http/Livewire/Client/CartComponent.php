<?php

namespace App\Http\Livewire\Client;

use App\Models\Dish;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public $cart;
    public $order;
    public $saved = false;

    public function render()
    {
        return view('livewire.client.cart-component');
    }

    public function makeOrder()
    {
        $this->cart = Cart::content();
        $restaurant_id = '';

        foreach ($this->cart as $item) {
            $restaurant_id = Dish::findOrFail($item->id)->getRestaurant->id;
        }

        $this->order = new Order;
        $this->order->client_id = auth()->id();
        $this->order->restaurant_id = $restaurant_id;
        $this->order->state = 'received';
        $this->order->save();

        //Saving the quantity of each item into pivot table 'dish_order'
        foreach ($this->cart as $item) {
            $this->order->getDishes()->attach(
                $item->id,
                ['quantity' => $item->qty, 'price_total' => ($item->price * $item->qty)]
            );
        }

        //Cleans a cart
        Cart::destroy();

        //Shows the alert about successful order
        $this->saved = true;
    }

    public function add($id)
    {
        $dish = Dish::findorfail($id);

        // Getting the restaurant of the cart to dont let to order dishes from different restaurants
        $restaurantCart = null;
        foreach (Cart::content() as $item) {
            $restaurantCart = Dish::find($item->id)->getRestaurant;
        }

        // Checking if the restaurants coincide
        if (!empty($restaurantCart)) {
            if ($dish->getRestaurant->id != $restaurantCart->id) {
                return redirect()->back()->withErrors(['Cannot add dishes from different restaurants.']);
            }
        }

        // Adding dishes
        Cart::add(
            $dish->id,
            $dish->name,
            1,
            $dish->price
        );

        return redirect()->back()->with('message', 'Added successfully!');
    }

    public function delete($id)
    {
        $item = Cart::content()->where('id', $id)->first();
        Cart::remove($item->rowId);
    }
}
