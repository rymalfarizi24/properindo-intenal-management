@props(['colspan'])

<tr>
    <td colspan="{{ $colspan }}" class="px-6 py-18 text-center">
        <x-ui.empty.empty-container>
            {{ $slot }}
        </x-ui.empty.empty-container>
    </td>
</tr>
