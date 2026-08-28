@props(['target', 'class' => ''])
<button type="submit" wire:loading.attr='disabled' wire:target='{{ $target }}'
    class="{{ $class }} cursor-pointer flex w-full justify-center items-center rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 transition px-3 h-10 text-sm/6 font-semibold shadow-xs focus:outline-none focus:ring-2 focus:ring-emerald-500/40 disabled:opacity-70 disabled:cursor-not-allowed">
    <div wire:loading wire:target='{{ $target }}'
        class="w-4 h-4 border-2 mx-auto border-gray-300 border-t-blue-600 rounded-full animate-spin"></div>
    <div wire:loading.remove wire:target='{{ $target }}'>{{ $slot }}</div>
</button>
