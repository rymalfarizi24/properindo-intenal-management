<form wire:submit.prevent="searching">
    <div class="flex shadow-xs rounded-base -space-x-0.5">
        {{-- Search Input --}}
        <input wire:model='search' type="search" id="search" name="search"
            class="min-w-24 px-3 py-2.5 bg-neutral-secondary-medium border rounded-l-base border-default-medium text-heading text-sm focus:z-10 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600 w-full placeholder:text-body"
            placeholder="Search for categories" autocomplete="off">

        {{-- Search Button --}}
        <button wire:loading.attr='disabled' type="submit"
            class="cursor-pointer text-white w-32 bg-emerald-600 hover:bg-emerald-700 shadow-xs font-medium leading-5 rounded-e-base text-sm px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 disabled:opacity-70 disabled:cursor-not-allowed">
            <div class="flex items-center" wire:loading.remove wire:target="searching">
                <x-icons.search size="16" />
                <span class="ml-1.5">Search</span>
            </div>

            <div wire:loading wire:target="searching"
                class="w-4 h-4 border-2 mx-auto border-gray-300 border-t-blue-600 rounded-full animate-spin">
            </div>
        </button>
    </div>
</form>
