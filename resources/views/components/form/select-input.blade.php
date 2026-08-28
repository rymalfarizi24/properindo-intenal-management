@props(['name', 'data', 'option' => 'name', 'empty' => 'Choose an option', 'label'])

<div>
    <x-form.label :name="$name">{{ $label }}</x-form.label>
    <select id="{{ $name }}" name="{{ $name }}" wire:model='{{ $name }}'
        class=" 
            block w-full rounded-lg px-4 py-3 text-sm text-gray-900
            bg-white border transition
            placeholder:text-gray-400
            focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600
            @error($name)
                border-red-500 focus:ring-red-500/30 focus:border-red-500
            @else
                border-gray-300
            @enderror
            ">
        <option value="" selected>
            {{ $empty }}
        </option>
        @foreach ($data as $item)
            <option value="{{ $item['id'] }}">
                {{ $item[$option] }}
            </option>
        @endforeach
    </select>

    <x-form.error-validation :name="$name" />
</div>
