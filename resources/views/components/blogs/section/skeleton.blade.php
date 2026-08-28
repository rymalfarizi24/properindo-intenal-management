<div class="pb-4 px-2 mx-auto max-w-7xl lg:px-6 animate-pulse">
    <div class="my-6 flex justify-between">
        <div class="h-5 bg-gray-300 rounded w-1/6"></div>
        <div class="h-8 bg-gray-300 rounded w-1/3"></div>
    </div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 my-4">
        @for ($i = 0; $i < 6; $i++)
            <x-ui.blog-card.skeleton />
        @endfor
    </div>
</div>
