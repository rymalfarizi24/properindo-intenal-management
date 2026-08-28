@props(['tag' => 'button', 'class' => ''])

<{{ $tag }} {{ $attributes }}
    class="{{ $class }} cursor-pointer inline-flex items-center gap-1.5 rounded-base
                   bg-emerald-600 px-3.5 py-2.5 text-sm font-medium text-white
                   shadow-sm hover:bg-emerald-700
                   focus:outline-none focus:ring-2 focus:ring-emerald-500/40">
    {{ $slot }}
    </{{ $tag }}>
