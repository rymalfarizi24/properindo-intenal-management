<div class="w-full mx-auto">

    {{-- Header --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            Dashboard Pekerjaan
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Ringkasan dan monitoring pekerjaan internal.
        </p>

    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

        {{-- Total --}}
        <x-ui.card-stat title="Total Pekerjaan" :value="$totalTasks" description="Seluruh pekerjaan">
            <x-slot:icon>
                <x-icons.task size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- Not Started --}}
        <x-ui.card-stat title="Belum Mulai" :value="$notStartedTasks" description="Menunggu untuk dikerjakan">
            <x-slot:icon>
                <x-icons.clock size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- In Progress --}}
        <x-ui.card-stat title="Dalam Proses" :value="$inProgressTasks" description="Sedang dikerjakan">
            <x-slot:icon>
                <x-icons.task-progress size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- Completed --}}
        <x-ui.card-stat title="Selesai" :value="$completedTasks" description="Pekerjaan telah selesai">
            <x-slot:icon>
                <x-icons.task-check size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- Approaching Deadline --}}
        <x-ui.card-stat title="Mendekati Deadline" :value="$approachingDeadlineTasks"
            description="Deadline dalam waktu dekat">
            <x-slot:icon>
                <x-icons.calendar size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- Overdue --}}
        <x-ui.card-stat title="Melewati Deadline" :value="$overdueTasks" description="Membutuhkan perhatian">
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
                    Status Pekerjaan
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Ringkasan pekerjaan berdasarkan status.
                </p>
            </div>


            <div class="space-y-5">

                {{-- Not Started --}}
                <div>

                    <div class="mb-2 flex justify-between text-sm">

                        <span class="text-gray-600">
                            Belum Mulai
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ $notStartedTasks }}
                        </span>

                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100">

                        <div class="h-full rounded-full bg-gray-400"
                            style="width: {{ $totalTasks > 0 ? ($notStartedTasks / $totalTasks) * 100 : 0 }}%">
                        </div>

                    </div>

                </div>


                {{-- In Progress --}}
                <div>

                    <div class="mb-2 flex justify-between text-sm">

                        <span class="text-gray-600">
                            Dalam Proses
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ $inProgressTasks }}
                        </span>

                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100">

                        <div class="h-full rounded-full bg-blue-500"
                            style="width: {{ $totalTasks > 0 ? ($inProgressTasks / $totalTasks) * 100 : 0 }}%">
                        </div>

                    </div>

                </div>


                {{-- Completed --}}
                <div>

                    <div class="mb-2 flex justify-between text-sm">

                        <span class="text-gray-600">
                            Selesai
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ $completedTasks }}
                        </span>

                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100">

                        <div class="h-full rounded-full bg-green-500"
                            style="width: {{ $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0 }}%">
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
                        Mendekati Deadline
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Pekerjaan yang membutuhkan perhatian.
                    </p>

                </div>

                <a href="/data/tasks" wire:navigate class="text-sm font-medium text-blue-600 hover:underline">

                    Lihat Semua

                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-gray-100 text-xs uppercase text-gray-500">

                        <tr>
                            <th class="pb-3 font-medium">
                                Pekerjaan
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

                                Tidak ada pekerjaan yang mendekati deadline.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </div>

</div>