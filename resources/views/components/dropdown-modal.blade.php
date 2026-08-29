@props(['data'])

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
                id=@js($data->id);
                title=@js($data->title); 
                employee_id=@js($data->employee_id);
                status=@js($data->status);
                priority=@js($data->priority);
                deadline=@js($data->deadline);
                ">
            <x-icons.pen size='20' />
            Edit
        </button>

        <hr class="border-gray-200">

        {{-- Delete --}}
        <x-delete-confirm :id="$data->id"
            buttonClass="w-full cursor-pointer flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition" />
    </div>
</div>