@props(['name'])

<p class="mt-0.5 h-3 text-xs text-red-600">
    @error($name)
        {{ $message }}
    @enderror
</p>
