<div>

    {{-- Filter Card --}}
    <section class="mb-6 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">

            {{-- Search --}}
            <div class="lg:col-span-4">

                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    Search
                </label>

                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name or email..."
                    class="block w-full rounded-lg border border-gray-300
                           bg-white px-3 py-2.5 text-sm text-gray-900
                           placeholder:text-gray-400
                           focus:border-blue-500 focus:outline-none
                           focus:ring-2 focus:ring-blue-100">

            </div>


            {{-- Department --}}
            <div class="lg:col-span-2">

                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    Department
                </label>

                <select wire:model.live="department" class="block w-full rounded-lg border border-gray-300
                           bg-white px-3 py-2.5 text-sm text-gray-900
                           focus:border-blue-500 focus:outline-none
                           focus:ring-2 focus:ring-blue-100">

                    <option value="">
                        All Departments
                    </option>

                    @foreach ($departments as $department)

                    <option value="{{ $department }}">
                        {{ $department }}
                    </option>

                    @endforeach

                </select>

            </div>


            {{-- Role --}}
            <div class="lg:col-span-2">

                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    Role
                </label>

                <select wire:model.live="role" class="block w-full rounded-lg border border-gray-300
                           bg-white px-3 py-2.5 text-sm text-gray-900
                           focus:border-blue-500 focus:outline-none
                           focus:ring-2 focus:ring-blue-100">

                    <option value="">
                        All Roles
                    </option>

                    <option value="employee">
                        Employee
                    </option>

                    <option value="supervisor">
                        Supervisor
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                </select>

            </div>


            {{-- Status --}}
            <div class="lg:col-span-2">

                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    Status
                </label>

                <select wire:model.live="status" class="block w-full rounded-lg border border-gray-300
                           bg-white px-3 py-2.5 text-sm text-gray-900
                           focus:border-blue-500 focus:outline-none
                           focus:ring-2 focus:ring-blue-100">

                    <option value="">
                        All Status
                    </option>

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
                        Inactive
                    </option>

                </select>

            </div>


            {{-- Reset --}}
            <div class="flex items-end lg:col-span-1">

                <button type="button" wire:click="resetFilters" class="flex w-full items-center justify-center
                           rounded-lg border border-gray-300 px-3 py-2.5
                           text-sm font-medium text-gray-700
                           transition hover:bg-gray-50">

                    Reset

                </button>

            </div>


            {{-- Export --}}
            <div class="flex items-end lg:col-span-1">

                <button type="button" wire:click="exportExcel" wire:loading.attr="disabled" class="flex w-full items-center justify-center
                           rounded-lg bg-green-600 px-3 py-2.5
                           text-sm font-medium text-white
                           transition cursor-pointer hover:bg-green-700
                           disabled:cursor-not-allowed disabled:opacity-60">

                    Export
                </button>

            </div>

        </div>

    </section>


    {{-- Table Card --}}
    <section class="overflow-hidden rounded-2xl border border-gray-100
               bg-white shadow-sm">


        {{-- Table Header --}}
        <div class="flex flex-col gap-2 border-b border-gray-100
                   px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="font-semibold text-gray-900">
                    Employee List
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    View and manage employee information.
                </p>

            </div>


            <span class="text-sm text-gray-500">

                {{ $employees->total() }}
                {{ Str::plural('employee', $employees->total()) }}

            </span>

        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="border-b border-gray-100 bg-gray-50
                           text-xs uppercase tracking-wide text-gray-500">

                    <tr>

                        <th class="px-6 py-4 font-medium">
                            #
                        </th>

                        <th class="px-6 py-4 font-medium">
                            Employee
                        </th>

                        <th class="px-6 py-4 font-medium">
                            Department
                        </th>

                        <th class="px-6 py-4 font-medium">
                            Position
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Role
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Joined
                        </th>

                        <th class="px-6 py-4 text-right font-medium">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($employees as $index => $employee)

                    <tr class="transition hover:bg-gray-50">

                        {{-- Number --}}
                        <td class="whitespace-nowrap px-6 py-4 text-gray-500">

                            {{ $employees->firstItem() + $index }}

                        </td>


                        {{-- Employee --}}
                        <td class="px-6 py-4">

                            <div class="font-medium text-gray-900">
                                {{ $employee->name }}
                            </div>

                            <div class="mt-1 text-xs text-gray-500">
                                {{ $employee->email }}
                            </div>

                        </td>


                        {{-- Department --}}
                        <td class="whitespace-nowrap px-6 py-4 text-gray-600">

                            {{ $employee->department }}

                        </td>


                        {{-- Position --}}
                        <td class="whitespace-nowrap px-6 py-4 text-gray-600">

                            {{ $employee->position }}

                        </td>


                        {{-- Role --}}
                        <td class="px-6 py-4 text-center">

                            @if ($employee->role === 'admin')

                            <span class="inline-flex rounded-full
                                               bg-purple-50 px-2.5 py-1
                                               text-xs font-medium
                                               text-purple-600">

                                Admin

                            </span>

                            @elseif ($employee->role === 'supervisor')

                            <span class="inline-flex rounded-full
                                               bg-blue-50 px-2.5 py-1
                                               text-xs font-medium
                                               text-blue-600">

                                Supervisor

                            </span>

                            @else

                            <span class="inline-flex rounded-full
                                               bg-gray-100 px-2.5 py-1
                                               text-xs font-medium
                                               text-gray-600">

                                Employee

                            </span>

                            @endif

                        </td>


                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">

                            @if ($employee->status)

                            <span class="inline-flex items-center gap-1.5
                                               rounded-full bg-green-50
                                               px-2.5 py-1 text-xs font-medium
                                               text-green-600">

                                <span class="h-1.5 w-1.5 rounded-full bg-green-500">
                                </span>

                                Active

                            </span>

                            @else

                            <span class="inline-flex items-center gap-1.5
                                               rounded-full bg-red-50
                                               px-2.5 py-1 text-xs font-medium
                                               text-red-600">

                                <span class="h-1.5 w-1.5 rounded-full bg-red-500">
                                </span>

                                Inactive

                            </span>

                            @endif

                        </td>


                        {{-- Joined --}}
                        <td class="whitespace-nowrap px-6 py-4
                                       text-center text-gray-600">

                            {{ $employee->created_at->format('d M Y') }}

                        </td>


                        {{-- Action --}}
                        <td class="px-6 py-4 text-right">

                            <x-dropdown :id="$employee->id" />

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="px-6 py-16 text-center">

                            <div class="mx-auto flex h-12 w-12
                                           items-center justify-center
                                           rounded-full bg-gray-100
                                           text-gray-400">

                                <x-icons.users size="24" />

                            </div>

                            <h3 class="mt-4 text-sm font-semibold
                                           text-gray-900">

                                No employees found

                            </h3>

                            <p class="mt-1 text-sm text-gray-500">

                                @if ($search)

                                No employees match "{{ $search }}".

                                @else

                                There are no employees available yet.

                                @endif

                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($employees->hasPages())

        <div class="border-t border-gray-100 px-6 py-4">

            {{ $employees->links(data: ['scrollTo' => false]) }}

        </div>

        @endif

    </section>

</div>