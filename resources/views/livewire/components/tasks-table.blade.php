<div>
    {{-- Search & Filter --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-7 gap-3 mb-6">

        {{-- Search --}}
        <div class="lg:col-span-2">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search tasks..."
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
        </div>

        {{-- PIC / Employee --}}
        @can('supervisor')
        <div>
            <select wire:model.live="employee"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option value="">All PICs</option>

                @foreach ($employees as $employee)
                <option value="{{ $employee['id'] }}">
                    {{ $employee['name'] }}
                </option>
                @endforeach
            </select>
        </div>
        @endcan

        {{-- Status --}}
        <div>
            <select wire:model.live="status"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="progress">Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        {{-- Deadline --}}
        <div>
            <select wire:model.live="deadline"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option value="">All Deadlines</option>
                <option value="-1">Overdue</option>
                <option value="1">24 Hours Later</option>
                <option value="2">2 Days Later</option>
                <option value="7">A Week Later</option>
                <option value="14">2 Weeks Later</option>
                <option value="30">A Month Later</option>
            </select>
        </div>

        {{-- Priority --}}
        <div>
            <select wire:model.live="priority"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option value="">All Priorities</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        {{-- Reset --}}
        <div class="flex items-center">
            <button type="button" wire:click="resetFilters"
                class="w-full px-4 py-2.5 cursor-pointer text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 focus:ring-4 focus:ring-gray-200">
                Reset
            </button>
        </div>

    </div>

    {{-- Table --}}
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">

            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">#</th>
                    <th scope="col" class="px-6 py-3 font-medium">Task</th>
                    @can('supervisor')
                    <th scope="col" class="px-6 py-3 font-medium">PIC</th>
                    @endcan
                    <th scope="col" class="px-6 py-3 font-medium text-center">Status</th>
                    <th scope="col" class="px-6 py-3 font-medium">Deadline</th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">Priority</th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tasks as $index => $task)
                <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">

                    <td class="px-6 py-4">
                        {{ $tasks->firstItem() + $index }}
                    </td>

                    <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                        {{ $task->title }}
                    </th>

                    @can('supervisor')
                    <td class="px-6 py-4">
                        {{ $task->employee->name }}
                    </td>
                    @endcan


                    <td class="px-6 py-4 text-center">
                        {{ ucfirst($task->status) }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $task->deadline->diffForHumans() }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ ucfirst($task->priority) }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        <x-dropdown-modal :data="$task" />
                    </td>

                </tr>
                @empty
                <x-ui.empty.empty-table colspan="7" :search="$search">
                    <p class="text-sm text-body">
                        Tidak ditemukan task dengan kata kunci dan filter yang sesuai. Coba kata kunci lain.
                    </p>
                </x-ui.empty.empty-table>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    <div class="my-2">
        {{ $tasks->links(data: ['scrollTo' => false]) }}
    </div>
</div>