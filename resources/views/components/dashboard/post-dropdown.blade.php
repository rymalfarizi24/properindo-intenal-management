@props(['slug', 'id', 'href'])

<div class="relative flex justify-center" x-data="{ isDropdown: false }" x-on:click.outside="isDropdown = false">
    <button @click="isDropdown = !isDropdown"
        class="cursor-pointer p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition">
        <x-icons.dropdown size='15' />
    </button>

    <!-- Dropdown -->
    <div x-show="isDropdown" x-cloak x-transition
        class="absolute z-20 mt-2 w-36 rounded-lg bg-white dark:bg-gray-800 overflow-hidden shadow-lg border border-gray-200">

        <!-- Show -->
        <a wire:navigate href="{{ $href . '/' . $slug }}"
            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
            <x-icons.eye size='20' />
            Show
        </a>

        <hr class="border-gray-200">

        <!-- Edit -->
        <a wire:navigate href="{{ $href . '/' . $slug }}/edit"
            class="flex items-center gap-2 px-4 py-2 text-sm 
                       text-blue-600 dark:text-blue-400
                       hover:bg-blue-50 dark:hover:bg-gray-700 transition">
            <x-icons.pen size='20' />
            Edit
        </a>
        <hr class="border-gray-200">

        {{-- Delete --}}
        <x-delete-confirm :id="$id"
            buttonClass="w-full cursor-pointer flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition" />
    </div>
</div>
