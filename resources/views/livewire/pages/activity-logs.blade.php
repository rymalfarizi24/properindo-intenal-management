<div x-data="{
        isOpenModal: false,
        selectedLog: null,
        employee_name: '',

        openModal(log) {
            this.isOpenModal = true;
            this.selectedLog = log;

            if (log?.action === 'update') {
                this.employee_name = log.employee.name ?? 'Unknown';
            } else if (log?.action === 'create') {
                this.employee_name = log.new_data.name ?? 'Unknown';
            } else {
                this.employee_name = log.old_data.name ?? 'Unknown';
            }
        },

        closeModal() {
            this.isOpenModal = false;
        }


    }" @keyup.escape="closeModal" class="w-full mx-auto">

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
                            <button x-on:click="
                                openModal(@js($log));
                            " class="font-medium text-blue-600 hover:text-blue-800 hover:underline cursor-pointer">
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

    <div x-show="isOpenModal" x-cloak x-on:toast.window="closeModal">
        <x-modal.layout title="Activity Detail" width="max-w-3xl">
            {{-- Modal Body --}}
            <div class="max-h-[70vh] overflow-y-auto p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-medium uppercase text-gray-400">
                            Action
                        </p>

                        <p x-text="selectedLog?.action" class="mt-1 font-medium text-gray-900 capitalize">
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase text-gray-400">
                            Date & Time
                        </p>
                        <p x-text="new Date(selectedLog?.created_at).toLocaleString('id-ID', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        })" class="mt-1 font-medium text-gray-900">
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase text-gray-400">
                            Employee
                        </p>
                        <p x-text="employee_name" class="mt-1 font-medium text-gray-900">
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase text-gray-400">
                            Changed By
                        </p>
                        <p x-text="selectedLog?.changed_by?.name" class="mt-1 font-medium text-gray-900">
                        </p>
                    </div>

                </div>
                </p>
            </div>

            {{-- Data Comparison --}}
            <div x-show="selectedLog?.action === 'update'" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                {{-- Old Data --}}
                <div>
                    <h3 class="mb-2 text-sm font-semibold text-gray-900">
                        Previous Data
                    </h3>
                    <div class="rounded-xl bg-gray-50 p-4
                                                                   font-mono text-xs text-gray-600">
                        <pre x-text="JSON.stringify(selectedLog?.old_data, null, 2)" class="whitespace-pre-wrap"></pre>
                    </div>
                </div>

                {{-- New Data --}}
                <div>
                    <h3 class="mb-2 text-sm font-semibold text-gray-900">
                        New Data
                    </h3>
                    <div class="rounded-xl bg-gray-50 p-4 font-mono text-xs text-gray-600">
                        <pre x-text="JSON.stringify(selectedLog?.new_data, null, 2)" class="whitespace-pre-wrap"></pre>

                    </div>
                </div>
            </div>

            <div x-show="selectedLog?.action === 'create'">
                <h3 class="mb-2 text-sm font-semibold text-gray-900">
                    Created Data
                </h3>
                <div class="rounded-xl bg-gray-50 p-4
                                                               font-mono text-xs text-gray-600">
                    <pre class="whitespace-pre-wrap" x-text="JSON.stringify(selectedLog?.new_data, null, 2)"></pre>
                </div>
            </div>

            <div x-show="selectedLog?.action === 'delete'">
                <h3 class="mb-2 text-sm font-semibold text-gray-900">
                    Deleted Data
                </h3>
                <div class="rounded-xl bg-gray-50 p-4 font-mono text-xs text-gray-600">
                    <p class="whitespace-pre-wrap" x-text="JSON.stringify(selectedLog?.old_data, null, 2)"></p>
                </div>
            </div>

            <div class="flex justify-end border-t border-gray-100 px-6 py-4">
                <button @click="closeModal"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer">
                    Close
                </button>
            </div>
        </x-modal.layout>
    </div>

</div>