@props(['name', 'data', 'option' => null, 'empty' => 'Choose an option', 'label', 'selected' => null, 'bg' => 'white'])

@php
$color = [
'white' => 'bg-white',
'neutral' => 'bg-neutral-secondary-medium',
]
@endphp

<div>
    <x-form.label :name="$name">{{ $label }}</x-form.label>
    <select id="{{ $name }}" name="{{ $name }}" wire:model='{{ $name }}' class="
            block w-full rounded-lg px-4 py-3 text-sm text-gray-900
            border transition bg-neutral-secondary-medium
            placeholder:text-gray-400
            focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600
            @error($name)
                border-red-500 focus:ring-red-500/30 focus:border-red-500
            @else
                border-gray-300
            @enderror
            ">
        <option value="" disabled>
            {{ $empty }}
        </option>

        @foreach ($data as $value => $item)
        <option value="{{ $value }}">
            {{ $item }}
        </option>
        @endforeach
    </select>

    <x-form.error-validation :name="$name" />
</div>