<x-app-layout>

    <div class="container">
        <div class="mb-5">
            <h2>Restaurant {{ $restaurant->name }}</h2>
            <p>{{ $restaurant->address }} | {{ $restaurant->city }}</p>
        </div>

        @livewire('client.dish-component', ['restaurant' => $restaurant])

    </div>

</x-app-layout>
