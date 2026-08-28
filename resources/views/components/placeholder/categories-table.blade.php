<div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
    <table class="w-full text-sm text-left rtl:text-right text-body">
        <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
            <tr>
                <th scope="col" class="px-6 py-3 font-medium">#</th>
                <th scope="col" class="px-6 py-3 font-medium">Category Name</th>
                <th scope="col" class="px-6 py-3 font-medium">Slug</th>
                <th scope="col" class="px-6 py-3 font-medium text-center">Color</th>
                <th scope="col" class="px-6 py-3 font-medium text-center">Action</th>
            </tr>
        </thead>

        <tbody class="animate-pulse w-full">
            @for ($i = 0; $i < 6; $i++)
                <tr class="border-b border-default">
                    <td class="px-6 py-5">
                        <div class="h-4 w-4 bg-gray-200 rounded"></div>
                    </td>

                    <td class="px-6 py-5">
                        <div class="h-4 w-32 bg-gray-200 rounded"></div>
                    </td>

                    <td class="px-6 py-5">
                        <div class="h-4 w-40 bg-gray-200 rounded"></div>
                    </td>

                    <td class="px-6 py-5 flex m-auto items-center justify-center">
                        <div class="w-6 h-6 rounded border bg-gray-200 mr-2"></div>
                        <div class="h-4 w-20 bg-gray-200 rounded"></div>
                    </td>

                    <td class="px-6 py-5">
                        <div class="h-4 w-4 bg-gray-200 mx-auto"></div>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>
