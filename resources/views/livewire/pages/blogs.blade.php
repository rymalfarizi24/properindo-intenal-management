@section('meta_description', 'Browse thoughtful articles on Artikula across various topics, written to inform, inspire,
    and spark deeper understanding.')

    <div class="bg-neutral-100 text-gray-800">
        {{-- Intro --}}
        <section class="bg-white border-b">
            <div class="max-w-5xl mx-auto px-6 py-20 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Search Article
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed max-w-3xl mx-auto">
                    Articles, ideas, and perspectives curated to spark curiosity.
                </p>
            </div>
        </section>

        {{-- Search Section --}}
        <section class="max-w-3xl mx-auto px-6 py-12">
            <livewire:components.search-blogs :category='$category' wire:model='search' />
            {{-- Filter Section --}}
            <div class="mx-auto flex flex-wrap justify-center items-center gap-2 py-2 h-16 px-2 lg:px-6">
                @if ($search)
                    <x-ui.filter-badge action="$set('search', '')" color="bg-blue-100 text-blue-800">
                        🔍 Search: {{ $search }}
                    </x-ui.filter-badge>
                @endif
                @if ($category)
                    <x-ui.filter-badge action="$set('category', '')" color="bg-green-100 text-green-700">
                        📁 Category: {{ $category }}
                    </x-ui.filter-badge>
                @endif

                @if ($author)
                    <x-ui.filter-badge action="$set('author', '')" color="bg-purple-100 text-purple-700">
                        ✍️ Author: {{ $author }}
                    </x-ui.filter-badge>
                @endif
            </div>
        </section>


        {{-- Posts Section --}}
        <livewire:components.blogs-section lazy :search="$search" :category="$category" :author="$author" />
    </div>
