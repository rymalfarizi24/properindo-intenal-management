@props(['category'])

<div class="relative flex justify-center" x-data="{ isDropdown: false }" x-on:click.outside="isDropdown = false">
    <button @click="isDropdown = !isDropdown"
        class="cursor-pointer p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition">
        <x-icons.dropdown size='15' />
    </button>

    <!-- Dropdown -->
    <div x-show="isDropdown" x-cloak x-transition
        class="absolute z-20 mt-2 w-36 rounded-lg bg-white dark:bg-gray-800 overflow-hidden shadow-lg border border-gray-200">
        <!-- Edit -->
        <button
            class="cursor-pointer w-full flex items-center gap-2 px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 transition"
            x-on:click="
                $dispatch('reset-error');
                isOpenModal=true;
                id=@js($category->id);
                name=@js($category->name); 
                slug=lastSlug=@js($category->slug);
                color=lastColor=@js($category->color);
                ">
            <x-icons.pen size='20' />
            Edit
        </button>

        <hr class="border-gray-200">

        {{-- Delete --}}
        <x-delete-confirm :id="$category->id"
            buttonClass="w-full cursor-pointer flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition" />
    </div>
</div>
