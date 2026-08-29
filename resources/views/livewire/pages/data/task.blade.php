<div>

    <div class="flex flex-col gap-6 sm:flex-row sm:justify-between items-center sm:mb-4">
        <x-title>Our Tasks</x-title>

        {{-- Create New Task --}}
        <div class="flex justify-end">
            <x-ui.button tag="a" wire:navigate href="/data/tasks/create" class="">
                <x-icons.task-add size="26" />
                New Task
            </x-ui.button>
        </div>
    </div>

    {{-- Tasks Table --}}
    <livewire:components.tasks-table lazy />
</div>