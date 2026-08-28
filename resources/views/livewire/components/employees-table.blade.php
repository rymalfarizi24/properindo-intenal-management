<div>
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