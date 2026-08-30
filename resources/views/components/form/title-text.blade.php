@props(['title', 'value'])

<div {{ $attributes->class(['mb-3']) }}>
    <h6 class="mb-2.5 text-sm font-bold text-gray-800">
        {{ $title }}
    </h6>

    <p class="text-sm text-gray-900">
        {{ $value }}
    </p>
</div>