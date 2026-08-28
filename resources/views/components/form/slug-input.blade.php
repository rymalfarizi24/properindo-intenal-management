@props([
    'target' => 'slug',
    'from',
    'label' => 'Slug',
])

<div x-data="{ target: @entangle($target), from: @entangle($from) }">
    <x-form.label name="slug">{{ $label }}</x-form.label>
    <div class="flex">
        <input wire:model="{{ $target }}" x-on:focus="!target ? target=slugify(from) : false"
            id="{{ $target }}" type="text" name="slug"
            class=" 
                block w-full rounded-lg px-4 py-3 text-sm text-gray-900
                bg-white border transition
                placeholder:text-gray-400
                focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600
                @error($target)
                    border-red-500 focus:ring-red-500/30 focus:border-red-500
                @else
                    border-gray-300
                @enderror
                " />
        <button x-on:click="target=slugify(from)" type="button"
            class="cursor-pointer p-3 ml-2 rounded-lg border border-gray-300 bg-white text-gray-600 shadow-sm transition hover:bg-gray-100 hover:text-gray-900 active:scale-95 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <x-icons.auto-text size='22' />
        </button>
    </div>

    <x-form.error-validation name="slug" />

</div>
