<a @if ($navigate) wire:navigate @endif href="{{ $href }}"
    class="
        group flex items-center gap-3 rounded-lg p-3
        font-medium transition
        {{ $active ? 'bg-emerald-100 text-emerald-700' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}
    ">
    <span
        class="
            transition
            {{ $active ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-600' }}
        ">
        {{ $icon }}
    </span>

    <span class="truncate">
        {{ $slot }}
    </span>
</a>
