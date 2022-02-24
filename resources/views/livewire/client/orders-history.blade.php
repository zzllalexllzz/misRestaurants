<div>

    @if ($orders)
        @forelse ($orders as $order)

            <div class="card mb-3">
                <div class="row p-3">
                    <div class="col-md-8  font-italic">
                        <div class="d-flex justify-content-around border-right">
                            <div class="row">
                                <p class="col"><strong>Reference <span>{{ $order->id }}</span></strong></p>
                            </div>
                            <div>
                                <div class="row">
                                    <p class="col pr-2">Order date</p>
                                    <p class="col pr-2">{{ $order->created_at }}</p>
                                </div>
                                {{-- <div class="row">
                                    <p class="col pr-2">Total</p>
                                    <p class="col pr-2">xxx &euro;</p>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-col">
                            <div class="mb-2  font-italic"><i class="fas fa-shipping-fast p-1"></i><span
                                    class="text-capitalize">
                                    {{ $order->state }}</span>
                            </div>
                            <a href="/invoice/{{ $order->id }}" class="btn btn-info btn-sm text-uppercase"
                                style="max-width: 8rem">See
                                order</a>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div>
                <p>No orders found.</p>
            </div>
    @endforelse
    @endif






</div>
