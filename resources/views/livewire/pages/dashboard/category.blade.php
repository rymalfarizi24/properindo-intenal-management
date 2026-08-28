<div x-data="{
    isOpenModal: false,
    id: @entangle('id'),
    name: @entangle('name'),
    slug: @entangle('slug'),
    color: @entangle('color'),
    lastColor: @entangle('lastColor'),
    lastSlug: @entangle('lastSlug')
}" @keyup.escape="isOpenModal=false">
    <x-title>Post Categories</x-title>
    <div class="flex flex-col gap-6 sm:flex-row sm:justify-between items-stretch mb-3 sm:mb-8">
        {{-- Search --}}
        <div class="basis-2/3 shrink-0">
            <livewire:components.default-search wire:model='search' />
        </div>
        {{-- Add Category --}}
        <div class="basis-1/3 flex justify-end">
            <x-ui.button wire:click='resetErrorInput'
                x-on:click="
                    isOpenModal=true;
                    id=null;
                    name=''; 
                    slug='';
                    color='#4A90E2';
                    lastColor='#4A90E2';
                    ">
                <x-icons.block-plus size='20' />
                New Category
            </x-ui.button>
        </div>
    </div>

    {{-- Table --}}
    <livewire:components.dashboard.category.categories-table lazy :search="$search" />

    {{-- Modal --}}
    <div x-show="isOpenModal" x-cloak x-on:toast.window="isOpenModal=false">
        <x-dashboard.categories.modal />
    </div>
</div>
