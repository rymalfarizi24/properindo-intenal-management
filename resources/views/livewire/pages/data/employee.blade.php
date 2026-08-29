<div>

    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <x-title>Employees</x-title>

            <p class="mt-1 text-sm text-gray-500">
                Manage and monitor employee information.
            </p>
        </div>

        @can('admin')
        <x-ui.button tag="a" wire:navigate href="/data/employees/create">
            <x-icons.user-add size="20" />
            New Employee
        </x-ui.button>
        @endcan

    </div>


    {{-- Employees Table --}}
    <livewire:components.employees-table lazy />

</div>