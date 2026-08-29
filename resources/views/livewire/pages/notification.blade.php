<div class="w-full mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Notifications
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Stay updated with your task deadlines and reminders.
        </p>
    </div>


    {{-- Notifications --}}
    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

        @forelse ($notifications as $notification)

        <div class="flex items-center gap-4 border-b border-gray-100 p-5 last:border-b-0
                       hover:bg-gray-50 transition">

            {{-- Icon --}}
            <div class="shrink-0">
                @if ($notification->type === 'reminder')
                <div class="flex h-14 w-14 items-center justify-center
                                   rounded-full bg-green-50 text-green-600">
                    <x-icons.clock size="28" />
                </div>
                @elseif ($notification->type === 'alert')
                <div class="flex h-14 w-14 items-center justify-center
                                   rounded-full bg-yellow-50 text-yellow-600">
                    <x-icons.warning size="28" />
                </div>

                @else
                <div class="flex h-14 w-14 items-center justify-center
                                   rounded-full bg-red-50 text-red-600">
                    <x-icons.notification size="28" />
                </div>
                @endif
            </div>


            {{-- Content --}}
            <div class="min-w-0 flex-1">

                <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">

                    <h2 class="text-sm font-semibold text-gray-900">
                        {{ $notification->title }}
                    </h2>

                    <span class="whitespace-nowrap text-xs text-gray-400">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>

                </div>


                <p class="mt-1 text-sm text-gray-600">
                    {{ $notification->message }}
                </p>


                {{-- Task Information --}}
                @if ($notification->task)

                <div class="mt-3 rounded-lg bg-gray-50 px-4 py-3">

                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-900">
                                {{ $notification->task->title }}
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                PIC:
                                {{ $notification->task->employee->name ?? '-' }}
                            </p>

                        </div>


                        <div class="text-left sm:text-right">

                            <p class="text-xs text-gray-400">
                                Deadline
                            </p>

                            <p class="text-sm font-medium text-gray-700">
                                {{ $notification->task->deadline->format('d M Y, H:i') }}
                            </p>

                        </div>

                    </div>

                </div>

                @endif

            </div>

        </div>

        @empty

        {{-- Empty State --}}
        <div class="px-6 py-16 text-center">

            <div class="mx-auto flex h-12 w-12 items-center justify-center
                           rounded-full bg-gray-100 text-gray-400">

                <x-icons.notification size="24" />

            </div>

            <h2 class="mt-4 text-sm font-semibold text-gray-900">
                No notifications
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                You don't have any notifications at the moment.
            </p>

        </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="my-2">
        {{ $notifications->links(data: ['scrollTo' => false]) }}
    </div>

</div>