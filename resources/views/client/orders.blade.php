<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    @livewire('client.orders-history')
</x-app-layout>
