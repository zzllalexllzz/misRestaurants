<x-intranet-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800">
            {{ __('Clients') }}
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

            @forelse ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->surname }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->address }}</td>
                    <td>{{ $client->city }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>
                        <a href="/intranet/clients/{{ $client->id }}/delete"><i class="fas fa-trash-alt"></i></a>
                        {{-- <a href="/intranet/clients/{{ $client->id }}"><i class="fas fa-clipboard-list"></i></a> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No clients found.</td>
                </tr>
            @endforelse

        </table>

        <div class="mx-auto">
            {{-- <div>{{ $clients->links() }}</div> --}}
        </div>

    </div>

</x-intranet-layout>
