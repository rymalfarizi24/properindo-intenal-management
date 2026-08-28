<div>
    <x-title>Welcome Back, {{ auth()->user()->username }}</x-title>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-ui.card-stat title="Total Posts" :value="abbreviate($total_posts_all, 2)" />
        <x-ui.card-stat title="This Year" :value="$total_posts_year" />
        <x-ui.card-stat title="This Month" :value="$total_posts_month" />
        <x-ui.card-stat title="Today" :value="$total_posts_today" />

        {{-- Chart Diagram --}}
        <section class="col-span-full lg:col-span-3">
            <livewire:components.dashboard.home.monthly-graphic lazy :scope="$scope" />
        </section>
        {{-- Circle Diagram --}}
        <section class="col-span-full lg:col-span-1">
            <livewire:components.dashboard.home.category-graphic lazy :scope="$scope" />
        </section>
    </div>
</div>
