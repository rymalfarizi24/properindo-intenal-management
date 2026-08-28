<div class="bg-white p-6 rounded-2xl w-full h-full border border-gray-100 shadow-sm space-y-4">
    <!-- Header -->
    <div class="flex justify-between gap-x-2">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Your Posts
            </h2>
            <p class="text-sm text-gray-500">
                Statistics for year
                @if ($selectedYear1 != $selectedYear2 && $selectedYear1)
                    {{ $selectedYear1 }} & {{ $selectedYear2 }}
                @else
                    {{ $selectedYear2 }}
                @endif
            </p>
        </div>

        <!-- Select -->
        @if (count($availableYears) > 0)
            <div class="flex md:flex-row flex-col items-center justify-center gap-2">
                <x-form.select-time model="selectedYear1" :data="$availableYears" />
                <span class="text-gray-700 hidden md:block">&</span>
                <x-form.select-time model="selectedYear2" :data="$availableYears" />
            </div>
        @endif
    </div>

    <!-- Chart -->
    <div class="bg-gray-50 rounded-xl">
        @if ($chart)
            <livewire:livewire-column-chart key="{{ $chart->reactiveKey() }}" :column-chart-model="$chart" />
        @else
            <div
                class="h-80 w-full flex flex-col items-center justify-center gap-3 rounded-lg border border-dashed border-gray-200 bg-gray-50 text-center">
                <!-- Icon -->
                <x-icons.analytic size="40" class="text-gray-400" />

                <!-- Text -->
                <p class="text-sm font-medium text-gray-600">
                    No posts yet
                </p>
                <p class="text-xs text-gray-400">
                    Your monthly post statistics will appear here
                </p>
            </div>
        @endif
    </div>
</div>
