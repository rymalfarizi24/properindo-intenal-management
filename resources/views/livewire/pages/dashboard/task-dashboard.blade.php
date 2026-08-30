<div class="w-full mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Task Dashboard
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Overview and monitoring of internal tasks.
        </p>
    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

        {{-- Total --}}
        <x-ui.card-stat title="Total Tasks" :value="$totalTasks" description="All tasks" color="blue">
            <x-slot:icon>
                <x-icons.task size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- Not Started --}}
        <x-ui.card-stat title="Pending" :value="$statusCounts['pending'] ?? 0" description="Waiting to be started"
            color="gray">
            <x-slot:icon>
                <x-icons.clock size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- In Progress --}}
        <x-ui.card-stat title="Progress" :value="$statusCounts['progress'] ?? 0" description="Currently being worked on"
            color="blue">
            <x-slot:icon>
                <x-icons.task-progress size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- Completed --}}
        <x-ui.card-stat title="Completed" :value="$statusCounts['completed'] ?? 0" description="Completed tasks"
            color="green">
            <x-slot:icon>
                <x-icons.task-check size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- Approaching Deadline --}}
        <x-ui.card-stat title="Approaching Deadline" :value="$approachingDeadlineTasks" description="Tasks due soon"
            color="yellow">
            <x-slot:icon>
                <x-icons.calendar size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- Overdue --}}
        <x-ui.card-stat title="Overdue" :value="$overdueTasks" description="Requires attention" color="red">
            <x-slot:icon>
                <x-icons.warning size="24" />
            </x-slot:icon>
        </x-ui.card-stat>

    </div>


    {{-- Bottom Section --}}
    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Task Status --}}
        <section class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

            <div class="mb-5">
                <h2 class="font-semibold text-gray-900">
                    Task Status
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Task summary by status.
                </p>
            </div>


            <div class="space-y-5">

                {{-- Pending --}}
                <div>
                    <div class="mb-2 flex justify-between text-sm">

                        <span class="text-gray-600">
                            Pending
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ $statusCounts['pending'] ?? 0 }}
                        </span>

                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100">

                        <div class="h-full rounded-full bg-gray-400"
                            style="width: {{ $totalTasks > 0 ? ($statusCounts['pending'] ?? 0) / $totalTasks * 100 : 0 }}%">
                        </div>

                    </div>
                </div>


                {{-- Progress --}}
                <div>
                    <div class="mb-2 flex justify-between text-sm">

                        <span class="text-gray-600">
                            Progress
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ $statusCounts['progress'] ?? 0 }}
                        </span>

                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100">

                        <div class="h-full rounded-full bg-blue-500"
                            style="width: {{ $totalTasks > 0 ? ($statusCounts['progress'] ?? 0) / $totalTasks * 100 : 0 }}%">
                        </div>

                    </div>
                </div>


                {{-- Completed --}}
                <div>
                    <div class="mb-2 flex justify-between text-sm">

                        <span class="text-gray-600">
                            Completed
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ $statusCounts['completed'] ?? 0 }}
                        </span>

                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100">

                        <div class="h-full rounded-full bg-green-500"
                            style="width: {{ $totalTasks > 0 ? ($statusCounts['completed'] ?? 0) / $totalTasks * 100 : 0 }}%">
                        </div>

                    </div>
                </div>

            </div>

        </section>


        {{-- Approaching Deadline --}}
        <section class="xl:col-span-2 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

            <div class="mb-5 flex items-start justify-between">

                <div>
                    <h2 class="font-semibold text-gray-900">
                        Approaching Deadline
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Tasks that require attention.
                    </p>
                </div>

                <a href="/data/tasks" wire:navigate class="text-sm font-medium text-blue-600 hover:underline">
                    View All
                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-gray-100 text-xs uppercase text-gray-500">

                        <tr>
                            <th class="pb-3 font-medium">
                                Task
                            </th>

                            <th class="pb-3 font-medium">
                                PIC
                            </th>

                            <th class="pb-3 font-medium">
                                Deadline
                            </th>

                            <th class="pb-3 font-medium">
                                Status
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse ($approachingTasks as $task)

                        <tr>

                            <td class="py-4 font-medium text-gray-900">
                                {{ $task->title }}
                            </td>

                            <td class="py-4 text-gray-600">
                                {{ $task->employee->name }}
                            </td>

                            <td class="py-4 text-gray-600">
                                {{ $task->deadline->format('d M H:i') }}
                            </td>

                            <td class="py-4">

                                <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-600">
                                    {{ ucfirst($task->status) }}
                                </span>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="py-8 text-center text-gray-500">
                                No tasks are approaching their deadline.
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </div>

</div>