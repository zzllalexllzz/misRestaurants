<x-intranet-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800">
            {{ __('Delivery men') }}
        </h1>
    </x-slot>

    <!-- Content Row 1 -->
    <div class="">

        <div class="d-flex flex-row my-3 justify-content-between align-items-center">
            {{-- <div>Search</div> --}}
        </div>

        <table class="table table-striped table-bordered table-sm" width="100%">
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Address</th>
                <th>City</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>

            @forelse ($deliverymen as $deliveryman)
                <tr>
                    <td>{{ $deliveryman->name }}</td>
                    <td>{{ $deliveryman->surname }}</td>
                    <td>{{ $deliveryman->email }}</td>
                    <td>{{ $deliveryman->address }}</td>
                    <td>{{ $deliveryman->city }}</td>
                    <td>{{ $deliveryman->phone }}</td>
                    <td>
                        <a href="/intranet/deliverymen/{{ $deliveryman->id }}/delete"><i class="fas fa-trash-alt"></i></a>
                        {{-- <a href="/intranet/deliverymen/{{ $deliveryman->id }}"><i class="fas fa-clipboard-list"></i></a> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No delivery men found.</td>
                </tr>
            @endforelse

        </table>

        <div class="mx-auto">
            {{-- <div>{{ $deliverymen->links() }}</div> --}}
        </div>

    </div>

</x-intranet-layout>
