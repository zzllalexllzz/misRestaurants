<x-intranet-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800">
            @if (isset($restaurant))
                {{ $restaurant->name }} {{ __('orders') }}
            @else
                {{ __('Orders') }}
            @endif
        </h1>
    </x-slot>

    @if (isset($restaurant))
        @livewire('orders', ['restaurant' => $restaurant])
    @endif

</x-intranet-layout>
