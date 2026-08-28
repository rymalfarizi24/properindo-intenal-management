@props(['title', 'value'])

<section class="bg-white p-6 h-full rounded-2xl border border-gray-100 shadow-sm">
    <p class="text-sm font-medium text-gray-500">
        {{ $title }}
    </p>
    <h2 class="mt-2 text-4xl font-bold text-gray-900">
        {{ $value }}
    </h2>
</section>
