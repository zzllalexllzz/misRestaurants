@props(['name'])

<input {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" id="{{ $name }}"
    type="text">
