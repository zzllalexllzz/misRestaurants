<x-intranet-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800">

            {{ __('Orders') }}
        </h1>
    </x-slot>

    @livewire('order-component')

</x-intranet-layout>
