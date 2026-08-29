<div>

    {{-- Filter Card --}}
    <section class="mb-6 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

        <div class="grid grid-cols-1 gap-3 lg:grid-cols-12">

            {{-- Search --}}
            <div class="lg:col-span-3">

                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    Search
                </label>

                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search tasks..." class="block w-full rounded-lg border border-gray-300
                       bg-white px-3 py-2.5 text-sm text-gray-900
                       placeholder:text-gray-400
                       focus:border-blue-500 focus:outline-none
                       focus:ring-2 focus:ring-blue-100">

            </div>


            {{-- PIC --}}
            @can('supervisor')
            <div class="lg:col-span-2">

                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    PIC
                </label>

                <select wire:model.live="employee" class="block w-full rounded-lg border border-gray-300
                           bg-white px-3 py-2.5 text-sm text-gray-900
                           focus:border-blue-500 focus:outline-none
                           focus:ring-2 focus:ring-blue-100">

                    <option value="">
                        All PICs
                    </option>

                    @foreach ($employees as $employee_id => $employee_name)

                    <option value="{{ $employee_id }}">
                        {{ $employee_name }}
                    </option>

                    @endforeach

                </select>

            </div>
            @endcan


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

                    <option value="pending">
                        Pending
                    </option>

                    <option value="progress">
                        Progress
                    </option>

                    <option value="completed">
                        Completed
                    </option>

                </select>

            </div>


            {{-- Deadline --}}
            <div class="lg:col-span-2">

                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    Deadline
                </label>

                <select wire:model.live="deadline" class="block w-full rounded-lg border border-gray-300
                       bg-white px-3 py-2.5 text-sm text-gray-900
                       focus:border-blue-500 focus:outline-none
                       focus:ring-2 focus:ring-blue-100">

                    <option value="">
                        All Deadlines
                    </option>

                    <option value="-1">
                        Overdue
                    </option>

                    <option value="1">
                        Within 24 Hours
                    </option>

                    <option value="2">
                        Within 2 Days
                    </option>

                    <option value="7">
                        Within 1 Week
                    </option>

                    <option value="14">
                        Within 2 Weeks
                    </option>

                    <option value="30">
                        Within 1 Month
                    </option>

                </select>

            </div>


            {{-- Priority --}}
            <div class="lg:col-span-2">

                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    Priority
                </label>

                <select wire:model.live="priority" class="block w-full rounded-lg border border-gray-300
                       bg-white px-3 py-2.5 text-sm text-gray-900
                       focus:border-blue-500 focus:outline-none
                       focus:ring-2 focus:ring-blue-100">

                    <option value="">
                        All Priorities
                    </option>

                    <option value="low">
                        Low
                    </option>

                    <option value="medium">
                        Medium
                    </option>

                    <option value="high">
                        High
                    </option>

                </select>

            </div>


            {{-- Reset --}}
            <div class="flex items-end lg:col-span-1">

                <button type="button" wire:click="resetFilters" class="flex w-full items-center justify-center
                       rounded-lg border border-gray-300
                       px-3 py-2.5 text-sm font-medium
                       text-gray-700 transition
                       hover:bg-gray-50 cursor-pointer">
                    Reset
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
                    Task List
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    View task progress and monitor upcoming deadlines.
                </p>

            </div>


            <span class="text-sm text-gray-500">

                {{ $tasks->total() }}
                {{ Str::plural('task', $tasks->total()) }}

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
                            Task
                        </th>

                        @can('supervisor')
                        <th class="px-6 py-4 font-medium">
                            PIC
                        </th>
                        @endcan

                        <th class="px-6 py-4 text-center font-medium">
                            Status
                        </th>

                        <th class="px-6 py-4 font-medium">
                            Deadline
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Priority
                        </th>

                        <th class="px-6 py-4 text-right font-medium">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($tasks as $index => $task)

                    <tr class="transition hover:bg-gray-50">

                        {{-- Number --}}
                        <td class="px-6 py-4 text-gray-500">

                            {{ $tasks->firstItem() + $index }}

                        </td>


                        {{-- Task --}}
                        <td class="px-6 py-4">

                            <div class="font-medium text-gray-900">
                                {{ $task->title }}
                            </div>

                        </td>


                        {{-- PIC --}}
                        @can('supervisor')

                        <td class="px-6 py-4 text-gray-600">

                            {{ $task->employee->name }}

                        </td>

                        @endcan


                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">

                            @if ($task->status === 'pending')

                            <span class="inline-flex rounded-full
                                           bg-gray-100 px-2.5 py-1
                                           text-xs font-medium
                                           text-gray-600">
                                Pending
                            </span>

                            @elseif ($task->status === 'progress')

                            <span class="inline-flex rounded-full
                                           bg-blue-50 px-2.5 py-1
                                           text-xs font-medium
                                           text-blue-600">
                                Progress
                            </span>

                            @elseif ($task->status === 'completed')

                            <span class="inline-flex rounded-full
                                           bg-green-50 px-2.5 py-1
                                           text-xs font-medium
                                           text-green-600">
                                Completed
                            </span>

                            @endif

                        </td>


                        {{-- Deadline --}}
                        <td class="px-6 py-4">

                            @if ($task->status === 'completed')

                            <span class="text-gray-500">
                                {{ $task->deadline->format('d M Y') }}
                            </span>

                            @elseif ($task->deadline->isPast())

                            <div class="font-medium text-red-600">

                                {{ $task->deadline->format('d M Y') }}

                            </div>

                            <div class="mt-1 text-xs text-red-500">

                                {{ $task->deadline->diffForHumans() }}

                            </div>

                            @else

                            <div class="font-medium text-gray-700">

                                {{ $task->deadline->format('d M Y') }}

                            </div>

                            <div class="mt-1 text-xs text-gray-500">

                                {{ $task->deadline->diffForHumans() }}

                            </div>

                            @endif

                        </td>


                        {{-- Priority --}}
                        <td class="px-6 py-4 text-center">

                            @if ($task->priority === 'high')

                            <span class="inline-flex rounded-full
                                           bg-red-50 px-2.5 py-1
                                           text-xs font-medium
                                           text-red-600">
                                High
                            </span>

                            @elseif ($task->priority === 'medium')

                            <span class="inline-flex rounded-full
                                           bg-yellow-50 px-2.5 py-1
                                           text-xs font-medium
                                           text-yellow-600">
                                Medium
                            </span>

                            @else

                            <span class="inline-flex rounded-full
                                           bg-green-50 px-2.5 py-1
                                           text-xs font-medium
                                           text-green-600">
                                Low
                            </span>

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right">

                            @can('admin')

                            <x-dropdown-modal :data="$task" />

                            @else

                            <button type="button" class="inline-flex cursor-pointer
                                           items-center justify-center
                                           rounded-lg px-3 py-2
                                           text-sm font-medium
                                           text-blue-600 transition
                                           hover:bg-blue-50" x-on:click="
                                        $dispatch('reset-error');
                                        isOpenModal = true;
                                        id = @js($task->id);
                                        title = @js($task->title);
                                        employee_id = @js($task->employee_id);
                                        status = @js($task->status);
                                        priority = @js($task->priority);
                                        deadline = @js($task->deadline);
                                    ">

                                <x-icons.pen size="18" />

                                <span class="ml-1">
                                    Update
                                </span>

                            </button>

                            @endcan

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="{{ Gate::allows('supervisor') ? 7 : 6 }}" class="px-6 py-16 text-center">

                            <div class="mx-auto flex h-12 w-12
                                       items-center justify-center
                                       rounded-full bg-gray-100
                                       text-gray-400">

                                <x-icons.task size="24" />

                            </div>


                            <h3 class="mt-4 text-sm font-semibold
                                       text-gray-900">
                                No tasks found
                            </h3>


                            <p class="mt-1 text-sm text-gray-500">

                                @if ($search)

                                No tasks match your search or filters.

                                @else

                                There are no tasks available yet.

                                @endif

                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if ($tasks->hasPages())
        <div class="border-t border-gray-100 px-6 py-4">
            {{ $tasks->links(data: ['scrollTo' => false]) }}
        </div>
        @endif

    </section>

</div>