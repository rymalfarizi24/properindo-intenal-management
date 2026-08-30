@props([
'title',
'value',
'description' => null,
'color' => 'gray',
])

@php
$colors = [
'gray' => 'bg-gray-100 text-gray-600',
'blue' => 'bg-blue-50 text-blue-600',
'green' => 'bg-green-50 text-green-600',
'yellow' => 'bg-yellow-50 text-yellow-600',
'red' => 'bg-red-50 text-red-600',
];
@endphp

<section class="flex items-start justify-between rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

    <div>
        <p class="text-sm font-medium text-gray-500">
            {{ $title }}
        </p>

        <h2 class="mt-2 text-3xl font-bold text-gray-900">
            {{ $value }}
        </h2>

        @if ($description)
        <p class="mt-1 text-xs text-gray-400">
            {{ $description }}
        </p>
        @endif
    </div>

    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl
                {{ $colors[$color] }}">
        {{ $icon ?? '' }}
    </div>

</section>