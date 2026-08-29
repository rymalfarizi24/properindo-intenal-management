<div>
    {{-- Search & Filter --}}
    <div class="grid grid-cols-10 gap-3 mb-6">

        {{-- Search --}}
        <div class="col-span-4">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search employee..."
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
        </div>

        {{-- Department --}}
        <div class="col-span-2">
            <select wire:model.live="department"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option value="">All Departments</option>

                @foreach ($departments as $department)
                <option value="{{ $department }}">
                    {{ $department }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Role --}}
        <div class="col-span-2">
            <select wire:model.live="role"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option value="">All Roles</option>
                <option value="employee">Employee</option>
                <option value="admin">Admin</option>
                <option value="supervisor">Supervisor</option>
            </select>
        </div>

        {{-- Status --}}
        <div class="col-span-2">
            <select wire:model.live="status"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option value="">All Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        {{-- Reset --}}
        <div class="col-span-5">
            <button type="button" wire:click="resetFilters"
                class="w-full px-4 py-2.5 cursor-pointer text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 focus:ring-4 focus:ring-gray-200">
                Reset
            </button>
        </div>

        {{-- Export to Excel --}}
        <div class="col-span-5">
            <button type="button" wire:click="exportExcel"
                class="w-full px-4 py-2.5 cursor-pointer text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 focus:ring-4 focus:ring-gray-200">
                Export to Excel
            </button>
        </div>

    </div>

    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Department
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Position
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Entered At
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $index => $employee)
                <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                    <td class="px-6 py-4">
                        {{ $employees->firstItem() + $index }}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                        {{ $employee->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $employee->department }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $employee->position }}
                    </td>
                    <td class="px-6 py-4">
                        {{ ucfirst($employee->role) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $employee->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $employee->status ? 'Active' : 'Inactive' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $employee->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <x-dropdown :id="$employee->id" />
                    </td>
                </tr>
                @empty
                <x-ui.empty.empty-table colspan="4" :search="$search">
                    <p class="text-sm text-body">
                        Tidak ditemukan artikel dengan kata kunci
                        <span class="font-medium text-heading">
                            "{{ $search }}"
                        </span>
                    </p>
                </x-ui.empty.empty-table>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Pagination --}}
    <div class="my-2">
        {{ $employees->links(data: ['scrollTo' => false]) }}
    </div>
</div>