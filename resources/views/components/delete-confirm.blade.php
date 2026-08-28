@props(['id', 'buttonClass'])

<section x-data="{ isDeleteModal: false }">
    {{-- Button Slot --}}
    <button @click="isDeleteModal=true" class="{{ $buttonClass }}">
        <x-icons.trash-can size='20' />
        Delete
    </button>

    {{-- Delete Modal --}}
    <div x-show="isDeleteModal" x-cloak
        class="bg-black/50 overflow-hidden fixed flex top-0 right-0 left-0 z-20 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div @click.outside="isDeleteModal=false"
                class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                <button @click="isDeleteModal=false" type="button"
                    class="absolute top-3 end-2.5 cursor-pointer text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center">
                    <x-icons.cross size="20" />

                </button>
                <div class="p-4 md:p-5 text-center">
                    <x-icons.rounded-danger size="48" class="mx-auto mb-4 text-fg-disabled" />
                    <h3 class="mb-6 text-body">Are you sure you want to delete this?</h3>
                    <div x-data="{ isLoading: false }" class="flex items-center space-x-4 justify-center">
                        <button wire:click="destroy({{ $id }}); isLoading=true" x-show="!isLoading"
                            type="button"
                            class="cursor-pointer text-white bg-red-600 box-border border border-transparent hover:bg-red-700 focus:ring-4 focus:ring-danger-medium shadow-xs font-medium leading-5 rounded-base text-sm self-stretch w-30 focus:outline-none">
                            Yes, I'm sure
                        </button>
                        {{-- Loading --}}
                        <button x-show="isLoading" x-on:toast.window="isDeleteModal=false; isLoading=false"
                            class="text-white bg-red-400 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm w-30 self-stretch focus:outline-none">
                            <div
                                class="w-4 h-4 border-2 mx-auto border-gray-300 border-t-blue-600 rounded-full animate-spin">
                            </div>
                        </button>

                        <button @click="isDeleteModal=false"
                            class="cursor-pointer text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
