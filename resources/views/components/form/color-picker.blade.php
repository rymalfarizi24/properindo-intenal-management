@props(['label' => 'Color', 'name' => 'color'])

<div>
    <label class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>
    <div wire:ignore x-data="{ color: @entangle($name) }" x-init="const picker = new Picker({ parent: $refs.button, popup: 'top' });
    picker.onDone = (val) => {
        color = val.hex;
    };" class="flex items-center">
        <button x-ref="button" class="size-10 cursor-pointer rounded border shadow-sm"
            :style="`background-color: ${color}`">
        </button>
        <span class="ml-2 font-mono" x-text="color"></span>
    </div>

    <x-form.error-validation :name="$name" />
</div>
