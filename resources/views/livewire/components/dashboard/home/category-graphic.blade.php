<div class="bg-white p-6 rounded-2xl shadow-sm h-full">
    <h3 class="font-semibold mb-4">Posts Category</h3>
    @if ($chart)
        {{-- Pie Chart --}}
        <livewire:livewire-pie-chart key="{{ $chart->reactiveKey() }}" :pie-chart-model="$chart" />
    @else
        {{-- Empty Data --}}
        <div
            class="min-h-80 w-full flex flex-col items-center justify-center gap-3 rounded-xl border border-dashed border-gray-200 bg-gray-50 text-center">
            <!-- Icon -->
            <x-icons.pie-chart size="36" class="text-gray-400" />
            <p class="text-sm font-medium text-gray-600">
                No posts yet
            </p>
            <p class="text-xs text-gray-400">
                Category posts will appear here
            </p>
        </div>
    @endif
</div>
