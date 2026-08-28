<form wire:submit.prevent="searching" x-data="{ isDropdown: false, category: @entangle('category') }">
    <div class="flex shadow-xs rounded-base -space-x-0.5">
        {{-- Select Category --}}
        <button id="dropdown-button" x-on:click="isDropdown=true" type="button"
            class="relative cursor-pointer inline-flex items-center z-10 text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600 font-medium leading-5 rounded-s-base text-sm px-3 sm:px-4 py-2.5 focus:outline-none">
            <x-icons.category size="16" class="me-1.5" />
            <span class="max-w-20 sm:max-w-35 truncate min-w-0 inline-block" x-text="slugToNormal(category)"></span>
            <x-icons.dropdown-line size="18" class="ms-1.5" />
            <div x-show="isDropdown" x-cloak x-on:click.outside="isDropdown=false"
                x-transition:enter="transition ease-out duration-200 origin-top"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200 origin-top"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                class="absolute max-w-full -bottom-1 translate-y-full left-0 z-10 bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg">
                <ul class="nav-list p-2 text-sm text-body font-medium" aria-labelledby="dropdown-button">
                    <li x-on:click.stop="isDropdown=false, category=''"
                        class="cursor-pointer p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded-md">
                        All Categories
                    </li>
                    @foreach ($categories as $ctr)
                        <li x-on:click.stop="isDropdown=false, category='{{ $ctr->slug }}'"
                            class="cursor-pointer p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded-md">
                            {{ $ctr->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </button>
        {{-- Search Input --}}
        <input wire:model='search' type="search" id="search" name="search"
            class="min-w-24 px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm focus:z-10 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600 w-full placeholder:text-body"
            placeholder="Search for articles" autocomplete="off">

        {{-- Search Button --}}
        <button wire:loading.attr='disabled' type="submit"
            class="cursor-pointer text-white sm:w-38 bg-emerald-600 hover:bg-emerald-700 shadow-xs font-medium leading-5 rounded-e-base text-sm px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 disabled:opacity-70 disabled:cursor-not-allowed">
            <div class="flex items-center" wire:loading.remove wire:target="searching">
                <x-icons.search size="16" />
                <span class="ml-1.5 hidden sm:inline">Search</span>
            </div>

            <div wire:loading wire:target="searching"
                class="w-4 h-4 border-2 mx-auto border-gray-300 border-t-blue-600 rounded-full animate-spin">
            </div>
        </button>
    </div>
</form>

<script>
    function slugToNormal(slug) {
        const categories = @js($categories);
        const category = categories.find(category => category.slug == slug);

        if (category) {
            return category.name;
        };
        return 'All Categories';
    }
</script>
