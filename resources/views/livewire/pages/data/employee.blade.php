<div>

    <div class="flex flex-col gap-6 sm:flex-row sm:justify-between items-center sm:mb-4">
        <x-title>Our Employees</x-title>

        {{-- Create New Employee --}}
        <div class="flex justify-end">
            <x-ui.button tag="a" wire:navigate href="/data/employees/create" class="">
                <x-icons.user-add size="26" />
                New Employee
            </x-ui.button>
        </div>
    </div>

    {{-- Employees Table --}}
    <livewire:components.employees-table />
</div>