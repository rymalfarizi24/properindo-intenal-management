<div>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $index => $post)
                    <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                        <td class="px-6 py-4">
                            {{ $posts->firstItem() + $index }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $post->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $post->category->name }}
                        </td>
                        <td class="px-6 py-4">
                            <x-dashboard.post-dropdown :id="$post->id" :slug="$post->slug" href="/dashboard/posts" />
                        </td>
                    </tr>
                @empty
                    <x-ui.empty.empty-table colspan="4" :search="$search">
                        <p class="text-sm text-body">
                            Tidak ditemukan artikel dengan kata kunci
                            <span class="font-medium text-heading">
                                "{{ $search }}"
                            </span>
                        </p>
                    </x-ui.empty.empty-table>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Pagination --}}
    <div class="my-2">
        {{ $posts->links(data: ['scrollTo' => false]) }}
    </div>
</div>
