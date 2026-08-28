@props(['name'])

<label for="{{ $name }}" class="block mb-2.5 text-sm font-medium text-gray-800">
    {{ $slot }}
</label>