<div>

    <div class="d-sm-flex justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">
            {{ __('Order ') }} {{ $order->id . ' - ' . $order->state }}
            <a href="/intranet/restaurants/{{ $order->restaurant_id }}">
                <h4 class="mt-1 text-muted"><small>{{ __('Restaurant ') }}
                        {{ $order->getRestaurant->name }}</small></h4>
            </a>
        </div>
        <div>
            @can('update', $order)
                @if (auth()->user()->role->name === 'Restaurant_manager')
                    <a wire:click="edit({{ $order->id }})" href="#" data-toggle="modal" data-target="#openModal"
                        class="btn btn-primary" title="Edit state"><i class="fas fa-edit"></i> Edit state</a>
                @elseif ( auth()->id() === $order->deliveryman_id)
                    <a wire:click="edit({{ $order->id }})" href="#" data-toggle="modal" data-target="#openModal"
                        class="btn btn-primary" title="Edit state"><i class="fas fa-edit"></i> Edit state</a>
                @endif
                @if (auth()->user()->role->name === 'Deliveryman' && $order->deliveryman_id == null)
                    <button wire:click="deliver({{ $order->id }}, {{ auth()->id() }})"
                        class="btn btn-primary">Deliver</i></button>
                @endif
            @endcan
        </div>
    </div>

    <div class="d-flex flex-column flex-sm-column flex-md-column flex-lg-row   mb-4">
        <div class="w-100 p-0 mr-5">
            <x-table.table class="table table-bordered table-light table-hover table-sm">
                <x-slot name="head">
                    <x-table.heading>Dish</x-table.heading>
                    <x-table.heading>Amount</x-table.heading>
                    <x-table.heading>Price</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach ($dishes as $dish)
                        @php
                            $total_payment += $dish->pivot->price_total;
                            $total_quantity += $dish->pivot->quantity;
                        @endphp
                        <x-table.row>
                            <x-table.cell>{{ App\Models\Dish::find($dish->pivot->dish_id)->name }}</x-table.cell>
                            <x-table.cell>{{ $dish->pivot->quantity }}</x-table.cell>
                            <x-table.cell>{{ number_format($dish->pivot->price_total, 2) }} &euro;</x-table.cell>
                        </x-table.row>
                    @endforeach
                    <x-table.row class="font-weight-bold table-warning">
                        <x-table.cell>TOTAL</x-table.cell>
                        <x-table.cell>{{ $total_quantity }}</x-table.cell>
                        <x-table.cell>{{ number_format($total_payment, 2) }} &euro;</x-table.cell>
                    </x-table.row>
                </x-slot>
            </x-table.table>
        </div>
        <div class="w-100 p-0">
            <x-table.table class="table table-bordered table-light table-hover table-sm">
                <x-slot name="head">
                    <x-table.heading>Client</x-table.heading>
                    <x-table.heading></x-table.heading>
                </x-slot>
                <x-slot name="body">
                    <x-table.row>
                        <x-table.heading>Name</x-table.heading>
                        <x-table.cell>{{ $client->name }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.heading>Surname</x-table.heading>
                        <x-table.cell>{{ $client->surname }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.heading>Address</x-table.heading>
                        <x-table.cell>{{ $client->address }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.heading>City</x-table.heading>
                        <x-table.cell>{{ $client->city }}</x-table.cell>
                    </x-table.row>
                    <x-table.row class="table-info">
                        <x-table.heading>Phone</x-table.heading>
                        <x-table.cell>{{ $client->phone }}</x-table.cell>
                    </x-table.row>
                </x-slot>
            </x-table.table>
        </div>
    </div>

    <a href="{{ url()->previous() }}">
        <x-button.primary><i class="fas fa-chevron-left"></i> Go back</x-button.primary>
    </a>


    <!-- Update Order Modal -->
    <form>
        <x-modal.dialog wire:ignore.self id="openModal">
            <x-slot name="title">Edit Order</x-slot>
            <x-slot name="content">
                <x-input.group :error="$errors->first('editing.state')">
                    <x-input.select wire:model="editing.state" name="state">
                        @if (auth()->user()->role->name === 'Restaurant_manager')
                            <option value="received">Received</option>
                            <option value="prepared">Prepared</option>
                            <option value="canceled">Canceled</option>
                        @endif
                        @if (auth()->user()->role->name === 'Deliveryman')
                            <option value="prepared">Prepared</option>
                            <option value="delivered">Delivered</option>
                        @endif
                    </x-input.select>
                </x-input.group>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary data-dismiss="modal">Cancel</x-button.secondary>
                <x-button.primary wire:click.prevent="save()" id="submitModal">Save</x-button.primary>
            </x-slot>

        </x-modal.dialog>
    </form>


</div>
