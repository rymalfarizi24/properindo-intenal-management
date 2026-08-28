<x-modal.layout>
    <form wire:submit.prevent='save' class="pt-4 md:pt-6 flex flex-col space-y-2">
        {{-- Name --}}
        <x-form.input name="name" label="Category Name" />
        {{-- Slug --}}
        <x-form.slug-input from="name" />
        {{-- Color Picker --}}
        <x-form.color-picker name="color" label="Color" />
        <x-ui.submit-button target="save">
            <span x-text="id ? 'Edit' : 'Create'"></span>
        </x-ui.submit-button>
    </form>
</x-modal.layout>
