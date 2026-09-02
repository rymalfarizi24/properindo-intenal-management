<div class="w-full mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Activity Logs
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Track changes made to employee data.
        </p>
    </div>


    {{-- Filters --}}
    <div class="mb-6 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            {{-- Search --}}
            <div>
                <label for="search" class="mb-1.5 block text-sm font-medium text-gray-700">

                    Search

                </label>

                <input wire:model.live.debounce.300ms="search" type="text" id="search"
                    placeholder="Search employee or user..." class="w-full rounded-lg border border-gray-300
                           px-3 py-2 text-sm
                           focus:border-blue-500 focus:ring-blue-500">
            </div>


            {{-- Action --}}
            <div>
                <label for="action" class="mb-1.5 block text-sm font-medium text-gray-700">

                    Action

                </label>

                <select wire:model.live="action" id="action" class="w-full rounded-lg border border-gray-300
                           px-3 py-2 text-sm
                           focus:border-blue-500 focus:ring-blue-500">

                    <option value="">
                        All Actions
                    </option>

                    <option value="create">
                        Create
                    </option>

                    <option value="update">
                        Update
                    </option>

                    <option value="delete">
                        Delete
                    </option>

                </select>
            </div>


            {{-- Date --}}
            <div>
                <label for="date" class="mb-1.5 block text-sm font-medium text-gray-700">

                    Date

                </label>

                <input wire:model.live="date" type="date" id="date" class="w-full rounded-lg border border-gray-300
                           px-3 py-2 text-sm
                           focus:border-blue-500 focus:ring-blue-500">
            </div>

        </div>

    </div>


    {{-- Activity Table --}}
    <section class="overflow-hidden rounded-2xl border border-gray-100
               bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="border-b border-gray-100 bg-gray-50
                           text-xs uppercase text-gray-500">

                    <tr>

                        <th class="px-6 py-4 font-medium">
                            Date & Time
                        </th>

                        <th class="px-6 py-4 font-medium">
                            Action
                        </th>

                        <th class="px-6 py-4 font-medium">
                            Employee
                        </th>

                        <th class="px-6 py-4 font-medium">
                            Changed By
                        </th>

                        <th class="px-6 py-4 text-right font-medium">
                            Detail
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($logs as $log)

                    <tr class="hover:bg-gray-50">

                        {{-- Date --}}
                        <td class="whitespace-nowrap px-6 py-4">

                            <div class="font-medium text-gray-900">
                                {{ $log->created_at->format('d M Y') }}
                            </div>

                            <div class="mt-1 text-xs text-gray-500">
                                {{ $log->created_at->format('H:i') }}
                            </div>

                        </td>


                        {{-- Action --}}
                        <td class="px-6 py-4">

                            @if ($log->action === 'create')

                            <span class="rounded-full bg-green-50
                                               px-2.5 py-1 text-xs font-medium
                                               text-green-600">

                                Create

                            </span>

                            @elseif ($log->action === 'update')

                            <span class="rounded-full bg-blue-50
                                               px-2.5 py-1 text-xs font-medium
                                               text-blue-600">

                                Update

                            </span>

                            @else

                            <span class="rounded-full bg-red-50
                                               px-2.5 py-1 text-xs font-medium
                                               text-red-600">

                                Delete

                            </span>

                            @endif

                        </td>


                        @php
                            $employee = $this->getEmployeeName($log);
                        @endphp
                        {{-- Employee --}}
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">
                                {{ $employee['name'] ?? 'Unknown' }}
                            </div>
                            <div class="mt-1 text-xs text-gray-500">
                                {{ $employee['email'] ?? 'N/A' }}
                            </div>
                        </td>


                        {{-- Changed By --}}
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">
                                {{ $log->changedBy->name }}
                            </div>
                            <div class="mt-1 text-xs text-gray-500">
                                {{ ucfirst($log->changedBy->role) }}
                            </div>
                        </td>


                        {{-- Detail --}}
                        <td class="px-6 py-4 text-right">
                            <button wire:click="showDetail({{ $log->id }})" class="font-medium text-blue-600
                                           hover:text-blue-800 hover:underline cursor-pointer">

                                View Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-sm font-medium text-gray-900">
                                No activity logs found
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                Try changing your search or filter.
                            </p>
                        </td>

                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($logs->hasPages())

        <div class="border-t border-gray-100 px-6 py-4">
            {{ $logs->links() }}
        </div>

        @endif

    </section>


    {{-- Detail Modal --}}
    @if ($selectedLog)

    <div class="fixed inset-0 z-50 flex items-center justify-center
                   bg-black/50 p-4" wire:click.self="closeDetail">

        <div class="w-full max-w-3xl rounded-2xl bg-white shadow-xl">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between
                           border-b border-gray-100 px-6 py-4">

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        Activity Detail
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $selectedLog->created_at->format('d M Y H:i:s') }}
                    </p>

                </div>

                <button wire:click="closeDetail" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                    <x-icons.cross size="20" />
                </button>

            </div>


            {{-- Modal Body --}}
            <div class="max-h-[70vh] overflow-y-auto p-6">

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div>
                        <p class="text-xs font-medium uppercase text-gray-400">
                            Action
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ ucfirst($selectedLog->action) }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs font-medium uppercase text-gray-400">
                            Changed By
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $selectedLog->changedBy->name }}
                        </p>
                    </div>


                    <div class="sm:col-span-2">

                        <p class="text-xs font-medium uppercase text-gray-400">
                            Employee
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $this->getEmployeeName($selectedLog)['name'] ?? 'Unknown' }}
                        </p>

                    </div>

                </div>


                {{-- Data Comparison --}}
                @if ($selectedLog->action === 'update')

                <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">

                    {{-- Old Data --}}
                    <div>

                        <h3 class="mb-2 text-sm font-semibold text-gray-900">
                            Previous Data
                        </h3>

                        <div class="rounded-xl bg-gray-50 p-4
                                           font-mono text-xs text-gray-600">

                            <pre
                                class="whitespace-pre-wrap">{{ json_encode($selectedLog->old_data, JSON_PRETTY_PRINT) }}</pre>

                        </div>

                    </div>


                    {{-- New Data --}}
                    <div>

                        <h3 class="mb-2 text-sm font-semibold text-gray-900">
                            New Data
                        </h3>

                        <div class="rounded-xl bg-gray-50 p-4
                                           font-mono text-xs text-gray-600">

                            <pre
                                class="whitespace-pre-wrap">{{ json_encode($selectedLog->new_data, JSON_PRETTY_PRINT) }}</pre>

                        </div>

                    </div>

                </div>

                @elseif ($selectedLog->action === 'create')

                <div class="mt-6">

                    <h3 class="mb-2 text-sm font-semibold text-gray-900">
                        Created Data
                    </h3>

                    <div class="rounded-xl bg-gray-50 p-4
                                       font-mono text-xs text-gray-600">

                        <pre
                            class="whitespace-pre-wrap">{{ json_encode($selectedLog->new_data, JSON_PRETTY_PRINT) }}</pre>

                    </div>

                </div>

                @elseif ($selectedLog->action === 'delete')

                <div class="mt-6">

                    <h3 class="mb-2 text-sm font-semibold text-gray-900">
                        Deleted Data
                    </h3>

                    <div class="rounded-xl bg-gray-50 p-4
                                       font-mono text-xs text-gray-600">

                        <pre
                            class="whitespace-pre-wrap">{{ json_encode($selectedLog->old_data, JSON_PRETTY_PRINT) }}</pre>

                    </div>

                </div>

                @endif

            </div>


            {{-- Modal Footer --}}
            <div class="flex justify-end border-t border-gray-100
                           px-6 py-4">

                <button wire:click="closeDetail" class="rounded-lg border border-gray-300
                               px-4 py-2 text-sm font-medium
                               text-gray-700 hover:bg-gray-50">

                    Close

                </button>

            </div>

        </div>

    </div>

    @endif

</div>