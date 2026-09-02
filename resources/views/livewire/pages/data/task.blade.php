<div x-data="{
        isOpenModal: false,
        id: @entangle('id'),
        title: @entangle('title'),
        employee_id: @entangle('employee_id'),
        status: @entangle('status'),
        priority: @entangle('priority'),
        deadline: @entangle('deadline'),
    }" @keyup.escape="isOpenModal = false">

    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <x-title>Tasks</x-title>

            <p class="mt-1 text-sm text-gray-500">
                Manage and monitor internal tasks and deadlines.
            </p>
        </div>

        {{-- Add New Task --}}
        @can('admin')
        <x-ui.button x-on:click="
                $dispatch('reset-error');
                isOpenModal = true;
                id = '';
                title = '';
                employee_id = '';
                status = '';
                priority = '';
                deadline = '';
            ">
            <x-icons.task-add size="20" />
            New Task
        </x-ui.button>
        @endcan

    </div>

    {{-- Tasks Table --}}
    <livewire:components.tasks-table :refresh-key="$refreshKey" lazy :employees="$employees" />

    {{-- Modal --}}
    <div x-show="isOpenModal" x-cloak x-on:toast.window="isOpenModal = false">
        <x-modal.task-modal :employees="$employees" />
    </div>

</div>