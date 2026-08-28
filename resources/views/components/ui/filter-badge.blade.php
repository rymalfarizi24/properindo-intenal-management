@props(['color', 'action'])

<div class="inline-flex items-center gap-2 px-3 py-1 text-sm font-medium rounded-full {{ $color }}">
    {{ $slot }}
    <button wire:click="{{ $action }}" class="cursor-pointer hover:font-semibold focus:outline-none">
        ✕
    </button>
</div>
