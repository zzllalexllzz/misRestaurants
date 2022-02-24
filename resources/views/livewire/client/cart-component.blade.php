<div>

    <div>
        @if ($saved)
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading">
                    <img src="{{ asset('storage/icons/checked.svg') }}" style="max-width:25px;" class="d-inline">
                    Your order is received! Order number - <strong>{{ $order->id }}</strong>
                </h4>
                <p></p>
                <hr>
                <p class="mb-0">Thank You for shopping at Food Gate</p>
            </div>
        @endif
    </div>

    <div>
        @if (count(Cart::content()))
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </thead>

                    <tbody>
                        @foreach (Cart::content() as $item)
                            <tr>
                                <td><a href="/dish/{{ $item->id }}">{{ $item->name }}</a></td>
                                <td>{{ $item->price }} &euro;</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ number_format($item->price * $item->qty, 2) }} &euro;</td>
                                <td>
                                    <button wire:click="delete({{ $item->id }})" type="button"
                                        class="btn btn-link text-danger">x</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Subtotal (with VAT):</td>
                            <td colspan="2"></td>
                            <td>{{ Cart::subtotal() }} &euro;</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>VAT (21%):</td>
                            <td colspan="2"></td>
                            <td>{{ Cart::tax() }} &euro;</td>
                            <td></td>
                        </tr>
                        <tr class="font-weight-bold">
                            <td>TOTAL:</td>
                            <td></td>
                            <td>{{ Cart::count() }}</td>
                            <td>{{ Cart::subtotal() }} &euro;</td>
                            <td></td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <form wire:submit.prevent="makeOrder">
                <button type="submit" class="btn btn-success float-right">Make an order</button>
            </form>

        @else
            <p>Cart is empty</p>
        @endif
    </div>

</div>
