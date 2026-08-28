<div class="flex flex-col text-center items-center gap-3 text-body">
    <x-icons.search-off size="44" />
    <div>
        <p class="font-medium text-heading">
            Tidak ada data yang cocok
        </p>
        {{ $slot }}
    </div>
    <button wire:click="resetSearch" class="cursor-pointer mt-2 text-sm font-medium text-primary hover:underline">
        Reset pencarian
    </button>
</div>
