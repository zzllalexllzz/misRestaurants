<x-intranet-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800">
            {{ $restaurant->name }} {{ __('dishes') }}
        </h1>
    </x-slot>

    @livewire('dish-component', ['restaurant' => $restaurant])

</x-intranet-layout>
