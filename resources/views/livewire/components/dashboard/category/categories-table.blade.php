<section>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Category Name
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Slug
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Color
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($categories) > 0)
                    @foreach ($categories as $index => $category)
                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                            <td class="px-6 py-4">
                                {{ $categories->firstItem() + $index }}
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ $category->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $category->slug }}
                            </td>
                            <td class="px-6 py-4 flex items-center">
                                <div class="w-6 h-6 rounded border shadow-sm mr-2"
                                    style="background-color: {{ $category->color }}"></div>
                                {{ $category->color }}
                            </td>
                            <td class="px-6 py-4">
                                <x-dashboard.categories.dropdown :category="$category" />
                            </td>
                        </tr>
                    @endforeach
                @else
                    <x-ui.empty.empty-table colspan="5" :search="$search">
                        <p class="text-sm text-body">
                            Tidak ditemukan artikel dengan kata kunci
                            <span class="font-medium text-heading">
                                "{{ $search }}"
                            </span>
                        </p>
                    </x-ui.empty.empty-table>
                @endif

            </tbody>
        </table>

    </div>
    <div class="my-2">
        {{ $categories->links(data: ['scrollTo' => false]) }}
    </div>
</section>
