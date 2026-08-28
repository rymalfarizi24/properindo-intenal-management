@section('meta_description',
    'Explore Artikula, a digital reading space featuring thoughtful articles, diverse
    perspectives, and curated insights to inspire curiosity and critical thinking.')

    <main class="bg-neutral-100 text-gray-800">
        <!-- Hero Section -->
        <section class="bg-linear-to-br from-slate-900 to-slate-800 text-white">
            <div class="max-w-7xl mx-auto px-6 py-16 text-center">
                <img src="{{ asset('img/logo/logo-name.png') }}" alt="Artikula Logo" class="mx-auto w-40 mb-6">

                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Artikula: Reading Space
                </h1>

                <p class="text-lg text-slate-300 max-w-2xl mx-auto mb-8">
                    A digital article publishing and discovery platform designed to share ideas,
                    expand knowledge, and connect readers through a unified reading space.
                </p>

                <!-- Search -->
                <div class="max-w-2xl mx-auto">
                    <form wire:submit='searching' class="flex bg-white rounded-xl shadow-lg overflow-hidden">
                        <input wire:model='search' type="search" placeholder="Search articles or topics..."
                            class="flex-1 px-5 py-4 text-gray-700 focus:outline-none">
                        <button type="submit"
                            class="px-6 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold transition">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="max-w-7xl mx-auto px-6 py-14">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 text-center">

                <div class="bg-white rounded-xl shadow p-8">
                    <h3 class="text-4xl font-bold text-emerald-600">{{ abbreviate($total_posts, 1) }}+</h3>
                    <p class="mt-2 text-gray-600">Total Articles</p>
                </div>

                <div class="bg-white rounded-xl shadow p-8">
                    <h3 class="text-4xl font-bold text-emerald-600">{{ $total_posts_year }}</h3>
                    <p class="mt-2 text-gray-600">Articles This Year</p>
                </div>

                <div class="bg-white rounded-xl shadow p-8">
                    <h3 class="text-4xl font-bold text-emerald-600">{{ $total_categories }}</h3>
                    <p class="mt-2 text-gray-600">Categories</p>
                </div>
                <div class="bg-white rounded-xl shadow p-8">
                    <h3 class="text-4xl font-bold text-emerald-600">{{ $total_authors }}</h3>
                    <p class="mt-2 text-gray-600">Author</p>
                </div>

            </div>
        </section>

        <!-- Popular Categories -->
        <section class="max-w-7xl mx-auto px-6 py-6">
            <h2 class="text-2xl font-bold mb-6">Popular Categories</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($popular_categories as $category)
                    <div class="p-5 bg-white rounded-lg shadow hover:shadow-md transition">
                        <h3 class="font-semibold">{{ $category['name'] }}</h3>
                        <p class="text-sm text-gray-500">{{ $category['posts_count'] }} articles</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Latest Articles -->
        <section class="bg-white">
            <div class="max-w-7xl mx-auto px-6 py-14">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Latest Articles</h2>
                    <a wire:navigate.hover href="/blogs" class="text-emerald-600 hover:underline text-sm">
                        View all
                    </a>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    @foreach ($latest_posts as $post)
                        <article class="border rounded-xl hover:shadow-md transition">
                            <div class="p-5">
                                <x-ui.category-badge :category="$post->category" />
                                {{-- <span class="text-xs font-semibold"
                                style="color: {{ $post->category->color }}">{{ $post->category->name }}</span> --}}
                                <h3 class="font-bold text-lg mt-2 mb-2">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ Str::limit(Str::of(html_entity_decode($post->body))->stripTags(), 130, '...', true) }}
                                </p>
                                <div class="mt-4 text-xs text-gray-500">
                                    By <span class="font-medium">{{ $post->author->name }}</span> •
                                    {{ $post->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- Call To Action -->
        <section class="bg-emerald-600 text-white">
            <div class="max-w-7xl mx-auto px-6 py-16 text-center">
                <h2 class="text-3xl font-bold mb-4">
                    Start Writing on Artikula
                </h2>
                <p class="mb-6 text-emerald-100">
                    Share your thoughts and articles with a broader audience.
                </p>
                <button wire:click='signIn' wire:loading.attr='disabled' wire:target='signIn'
                    class="cursor-pointer inline-block bg-white text-emerald-700 px-6 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition disabled:opacity-70 disabled:cursor-not-allowed">
                    Write an Article
                </button>
            </div>
        </section>

    </main>
