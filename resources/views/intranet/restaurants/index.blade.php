<x-intranet-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800">
            {{ __('Restaurants') }}
        </h1>
    </x-slot>

    @livewire('restaurant-component')

</x-intranet-layout>
