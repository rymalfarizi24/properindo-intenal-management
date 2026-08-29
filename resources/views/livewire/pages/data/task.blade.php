<div x-data="{
    isOpenModal: false,
    id: @entangle('id'),
    title: @entangle('title'),
    employee_id: @entangle('employee_id'),
    status: @entangle('status'),
    priority: @entangle('priority'),
    deadline: @entangle('deadline'),
}" @keyup.escape="isOpenModal=false">

    <div class="flex flex-col gap-6 sm:flex-row sm:justify-between items-center sm:mb-4">
        <x-title>Our Tasks</x-title>

        {{-- Add New Task --}}
        @can('admin')
        <x-ui.button x-on:click="
            isOpenModal=true;
            id='';
            title='';
            employee_id='';
            status='';
            priority='';
            deadline='';
        ">
            <x-icons.task-add size="26" />
            New Task
        </x-ui.button>
        @endcan
    </div>

    {{-- Tasks Table --}}
    <livewire:components.tasks-table lazy :employees="$employees" />

    {{-- Modal --}}
    <div x-show="isOpenModal" x-cloak x-on:toast.window="isOpenModal=false">
        <x-modal.task-modal :employees="$employees" />
    </div>
</div>