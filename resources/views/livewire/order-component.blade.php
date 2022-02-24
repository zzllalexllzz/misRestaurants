<div>

    <x-table.table>
        <x-slot name="head">
            <x-table.heading>Order ID</x-table.heading>
            <x-table.heading>Client</x-table.heading>
            <x-table.heading>Created at</x-table.heading>
            <x-table.heading>Updated at</x-table.heading>
            <x-table.heading>Deliveryman</x-table.heading>
            <x-table.heading>State</x-table.heading>
            <x-table.heading></x-table.heading>
        </x-slot>
        <x-slot name="body">
            @forelse ($orders as $order)
                <x-table.row>
                    <x-table.cell><a href="/intranet/orders/detail/{{ $order->id }}">{{ $order->id }}</a>
                    </x-table.cell>
                    <x-table.cell>{{ $order->getClient->name }}</x-table.cell>
                    <x-table.cell>{{ $order->created_at }}</x-table.cell>
                    <x-table.cell>{{ $order->updated_at }}</x-table.cell>
                    @if (isset($order->getDeliveryman))
                        <x-table.cell>{{ $order->getDeliveryman->name }} {{ $order->getDeliveryman->surname }}
                        </x-table.cell>
                    @else
                        <x-table.cell>not assigned</x-table.cell>
                    @endif
                    <x-table.cell>{{ $order->state }}</x-table.cell>
                    <x-table.cell>
                        @can('update', $order)
                            @if (auth()->user()->role->name === 'Restaurant_manager')
                                <a wire:click="edit({{ $order->id }})" href="#" data-toggle="modal" data-target="#openModal"
                                    class="btn btn-primary" title="Edit state"><i class="fas fa-edit"></i></a>
                            @elseif ( auth()->id() === $order->deliveryman_id)
                                <a wire:click="edit({{ $order->id }})" href="#" data-toggle="modal" data-target="#openModal"
                                    class="btn btn-primary" title="Edit state"><i class="fas fa-edit"></i></a>
                            @endif
                            @if (auth()->user()->role->name === 'Deliveryman' && $order->deliveryman_id == null)
                                <button wire:click="deliver({{ $order->id }}, {{ auth()->id() }})"
                                    class="btn btn-primary">Deliver</i></button>
                            @endif
                        @endcan
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <td colspan="6">No orders found.</td>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="mx-2">{{ $orders->links() }}</div>

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
