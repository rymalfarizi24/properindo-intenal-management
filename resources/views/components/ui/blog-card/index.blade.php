@props(['post'])

<article
    class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 flex flex-col">
    <div class="flex justify-between items-center mb-5 text-gray-500">
        <x-ui.category-badge :category="$post->category" variant="click" click="setCategory('{{ $post->category->slug }}')" />
        <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
    </div>
    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:underline"><a wire:navigate
            href="/blog/{{ $post->slug }}">{{ $post->title }}</a></h2>

    {{-- Body --}}
    <div class="mb-5 text-gray-500 flex-1">
        {{ Str::limit(Str::of(html_entity_decode($post->body))->stripTags(), 150, '...', true) }}
    </div>

    {{-- Author Profile --}}
    <button wire:click="setAuthor('{{ $post->author->username }}')"
        class="cursor-pointer flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img class="w-7 h-7 rounded-full" src="{{ asset('img/person-logo.png') }}"
                alt="{{ $post->author->name }}" />
            <span class="font-medium dark:text-white">
                {{ Str::limit($post->author->name, 18) }}
            </span>
        </div>
        <a wire:navigate href="/blog/{{ $post['slug'] }}"
            class="group inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
            Read more
            <x-icons.arrow size="16" class="ml-1 group-hover:translate-x-1 transition" />
        </a>
    </button>

</article>
