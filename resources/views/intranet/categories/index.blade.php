<x-intranet-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800">
            {{ __('Categories') }}
        </h1>
    </x-slot>

    @livewire('category-component')

</x-intranet-layout>
