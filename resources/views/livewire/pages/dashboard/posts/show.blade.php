<div>
    <x-title>My Post</x-title>
    <section class="px-6 pt-6 pb-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="mx-auto max-w-7xl ">
            <article
                class="mx-auto w-full max-w-5xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <div class="flex space-x-2 mb-2">
                    {{-- Back --}}
                    <a wire:navigate href="/dashboard/posts" class="inline-flex items-center px-4 py-2 text-sm font-medium
                  text-gray-700 border border-gray-300 rounded-lg
                  hover:bg-gray-100 transition">
                        &laquo; Back
                    </a>

                    {{-- Edit --}}
                    <a wire:navigate href="/dashboard/posts/{{ $post->slug }}/edit" class="inline-flex items-center gap-x-1 px-4 py-2 text-sm font-medium
              text-white bg-blue-600 rounded-lg
              hover:bg-blue-700 transition">
                        <x-icons.pen size='20' />
                        Edit
                    </a>

                    {{-- Delete --}}
                    <x-delete-confirm :id="$post->id"
                        buttonClass="cursor-pointer inline-flex items-center gap-x-1 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition" />
                </div>

                <x-ui.category-badge variant="redirect" :category="$post->category" />

                {{-- Post Body --}}
                {{-- Body Title --}}
                <h1
                    class="my-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                    {{ $post->title }}
                </h1>
                {{-- Body Image --}}
                @if ($imgPath)
                <img class="w-xl max-h-96 my-6 mx-auto object-cover" src="{{ $imgPath }}"
                    alt="{{ $post->title . ' Post Image' }}">
                @endif
                {{-- Body Text --}}
                <div>
                    {{ Str::of($post->body)->toHtmlString() }}
                </div>
            </article>
        </div>
    </section>
</div>