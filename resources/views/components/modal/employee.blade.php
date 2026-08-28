{{-- Employee Modal --}}
<x-modal.layout>
    <form wire:submit.prevent='save' class="pt-4 md:pt-6 flex flex-col space-y-2">
        {{-- Name --}}
        <x-form.input name="name" label="Employee Name" />
        {{-- Department --}}
        <x-form.input name="department" label="Department" />
        {{-- Position --}}
        <x-form.input name="position" label="Position" />
        {{-- Role --}}
        <x-form.select name="role" label="Role" :options="['admin' => 'Admin', 'user' => 'User']" />
        {{-- Email --}}
        <x-form.input name="email" label="Email" type="email" />
        {{-- Password --}}
        <x-form.input name="password" label="Password" type="password" />
        {{-- Confirm Password --}}
        <x-form.input name="password_confirmation" label="Confirm Password" type="password" />

        <x-ui.submit-button target="save">
            Save
        </x-ui.submit-button>
    </form>
</x-modal.layout>