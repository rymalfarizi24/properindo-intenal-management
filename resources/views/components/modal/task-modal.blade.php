<x-modal.layout title="Task Form">
    <form wire:submit.prevent='save' class="pt-4 grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-4">
        {{-- Name --}}
        <x-form.input name="title" label="Task" class="col-span-full" />
        {{-- PIC --}}
        <x-form.select-input :data="$employees" name="employee_id" label="PIC" empty="Choose PIC" />
        {{-- Status --}}
        <x-form.select-input :data="['pending' => 'Pending', 'progress' => 'Progress', 'completed' => 'Completed']"
            name="status" label="Status" empty="Choose status" />
        {{-- Priority --}}
        <x-form.select-input :data="['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']" name="priority"
            label="Priority" empty="Choose priority" />
        {{-- Deadline --}}
        <x-form.input name="deadline" label="Deadline" type="datetime-local" />
        {{-- PIC / Employee --}}


        {{-- Submit --}}
        <div class="w-full border-t border-default-medium pt-4 mt-2 col-span-full">
            <x-ui.submit-button target="save" class="col-span-full">
                <span x-text="id ? 'Edit' : 'Create'"></span>
            </x-ui.submit-button>
        </div>

    </form>
</x-modal.layout>