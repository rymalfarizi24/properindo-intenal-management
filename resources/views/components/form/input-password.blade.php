@props(['name' => 'password', 'placeholder' => 'Your password', 'label' => 'Password', 'class' => ''])

<div class="{{ $class }}">
    <x-form.label :name="$name">{{ $label }}</x-form.label>
    <div x-data="{ show: false }" class="relative">
        <div x-on:click="show=!show" class="cursor-pointer">
            <hr x-show="!show" x-transition:enter="transition-transform ease-out duration-100"
                x-transition:enter-start="scale-x-0" x-transition:enter-end="scale-x-100"
                x-transition:leave="transition-transform ease-in duration-100" x-transition:leave-start="scale-x-100"
                x-transition:leave-end="scale-x-0"
                class="w-5 transition z-5 border border-dark h-0 -rotate-45 absolute top-1/2 -translate-y-1/2 right-4">
            <x-icons.eye size="20" class="text-gray-400 absolute top-1/2 -translate-y-1/2 right-4" />
        </div>
        <input wire:model="{{ $name }}" :type="show ? 'text' : 'password'" name="{{ $name }}"
            id="{{ $name }}" autocomplete="{{ $name }}"
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
                "
            :placeholder="show ? @js($placeholder) : '••••••••'">
    </div>

    <x-form.error-validation :name="$name" />
</div>
