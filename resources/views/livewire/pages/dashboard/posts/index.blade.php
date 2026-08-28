<div>
    <x-title>My Posts</x-title>

    {{-- Search --}}
    <div class="flex flex-col gap-6 sm:flex-row sm:justify-between mb-3 sm:mb-8">
        <div class="basis-2/3 shrink-0">
            <livewire:components.search-blogs :category='$category' wire:model='search' />
        </div>

        <div class="basis-1/3 flex justify-end">
            <x-ui.button tag="a" wire:navigate href="/dashboard/posts/create" class="">
                <x-icons.post-add size="24" />
                New Post
            </x-ui.button>
        </div>
        {{-- Create New Post --}}
    </div>

    {{-- Posts Table --}}
    <livewire:components.posts-section lazy :search="$search" :category="$category" />
</div>
