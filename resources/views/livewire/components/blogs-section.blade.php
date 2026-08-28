<section class="pb-4 px-2 mx-auto max-w-7xl lg:px-6">
    {{ $posts->links(data: ['scrollTo' => false]) }}
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 my-4">
        @forelse ($posts as $post)
            {{-- Card --}}
            <x-ui.blog-card.index wire:key="{{ $post->id }}" :post="$post" />
        @empty
            <div class="col-span-full py-8">
                <x-ui.empty.empty-container colspan="4">
                    <p class="text-sm text-body">
                        Tidak ditemukan data dengan kata kunci tersebut
                    </p>
                </x-ui.empty.empty-container>
            </div>
        @endforelse
    </div>
    {{ $posts->links(data: ['scrollTo' => false]) }}
</section>
