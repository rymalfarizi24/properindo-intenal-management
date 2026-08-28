<section class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
    <table class="w-full text-sm text-left rtl:text-right text-body">
        <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
            <tr>
                <th class="px-6 py-3 font-medium">#</th>
                <th class="px-15 py-3 font-medium">Title</th>
                <th class="px-6 py-3 font-medium">Category</th>
                <th class="px-6 py-3 font-medium text-center">Action</th>
            </tr>
        </thead>

        <tbody class="animate-pulse w-full">
            @for ($i = 0; $i < 6; $i++)
                <tr class="border-b border-default">
                    <td class="px-6 py-5">
                        <div class="h-4 w-4 bg-gray-200 rounded"></div>
                    </td>

                    <td class="px-15 py-5">
                        <div class="h-4 w-72 bg-gray-200 rounded"></div>
                    </td>

                    <td class="px-6 py-5">
                        <div class="h-4 w-32 bg-gray-200 rounded"></div>
                    </td>

                    <td class="px-6 py-5">
                        <div class="h-4 w-4 mx-auto bg-gray-200"></div>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
</section>
