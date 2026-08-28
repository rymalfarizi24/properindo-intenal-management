<div>
    <x-title>Our Employees</x-title>

    {{-- Search --}}
    <div class="flex flex-col gap-6 sm:flex-row sm:justify-between mb-3 sm:mb-8">
        <div class="basis-2/3 shrink-0">
            {{--
            <livewire:components.search-blogs :category='$category' wire:model='search' /> --}}
        </div>

        <div class="basis-1/3 flex justify-end">
            <x-ui.button tag="a" wire:navigate href="/data/employees/create" class="">
                <x-icons.user-add size="26" />
                New Employee
            </x-ui.button>
        </div>
        {{-- Create New Employee --}}
    </div>

    {{-- Employees Table --}}
    <livewire:components.employees-table />
</div>