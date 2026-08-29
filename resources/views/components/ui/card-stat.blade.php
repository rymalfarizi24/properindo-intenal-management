@props([
'title',
'value',
'description' => null,
])

<section class="h-full rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

    <div class="flex items-start justify-between gap-4">

        <div>
            <p class="text-sm font-medium text-gray-500">
                {{ $title }}
            </p>

            <h2 class="mt-2 text-4xl font-bold text-gray-900">
                {{ $value }}
            </h2>

            @if ($description)
            <p class="mt-2 text-xs text-gray-500">
                {{ $description }}
            </p>
            @endif
        </div>

        @isset($icon)
        <div class="rounded-xl bg-gray-50 p-3 text-gray-600">
            {{ $icon }}
        </div>
        @endisset

    </div>

</section>