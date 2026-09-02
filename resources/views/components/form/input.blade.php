@props([
'type' => 'text',
'name',
'placeholder' => '',
'label',
'class' => '',
'autofocus' => false,
'variant' => 'default'
])

@php
$variants = [
'default' => 'py-3 text-sm placeholder:text-gray-400',
'contact' => 'py-2.5',
];
@endphp

<div class="{{ $class }}">
    <x-form.label :name="$name">{{ $label }}</x-form.label>

    <input wire:model="{{ $name }}" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" autocomplete="{{ $name }}" {{
        $autofocus ? 'autofocus' : '' }} class="{{ $variants[$variant] }}
            w-full rounded-lg px-4 text-gray-900 bg-neutral-secondary-medium
            transition focus:outline-none border
            focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600
            @error($name)
                border-red-500 focus:ring-red-500/30 focus:border-red-500
            @else
                @if ($variant == 'default')  
                border-gray-300
                @endif
            @enderror
        " placeholder="{{ $placeholder }}">

    <x-form.error-validation :name="$name" />
</div>