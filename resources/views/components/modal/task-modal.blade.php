<x-modal.layout title="Task Form">
    <form wire:submit.prevent='save' class="pt-4 grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-4">
        @can('supervisor')

        {{-- Name --}}
        <x-form.input name="title" label="Task" class="col-span-full" />
        {{-- PIC --}}
        <x-form.select-input :data="$employees" name="employee_id" label="PIC" empty="Choose PIC" />
        {{-- Priority --}}
        <x-form.select-input :data="['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']" name="priority"
            label="Priority" empty="Choose priority" />
        {{-- Deadline --}}
        <x-form.input name="deadline" label="Deadline" type="datetime-local" />
        @else
        {{-- Task --}}
        <div class="mb-3 col-span-full">
            <p class="text-sm font-medium text-gray-700">
                Task
            </p>

            <p x-text="title" class="mt-1 text-sm text-gray-900"></p>
        </div>

        {{-- Priority --}}
        <div class="mb-3">
            <p class="text-sm font-medium text-gray-700">
                Priority
            </p>

            <p x-text="priority" class="capitalize mt-1 text-sm text-gray-900"></p>
        </div>

        {{-- Deadline --}}
        <div class="mb-3">
            <p class="text-sm font-medium text-gray-700">
                Deadline
            </p>

            <p class="mt-1 text-sm text-gray-900" x-text="dateFormat(deadline)"></p>
        </div>

        @endcan
        {{-- Status --}}
        <x-form.select-input :data="['pending' => 'Pending', 'progress' => 'Progress', 'completed' => 'Completed']"
            name="status" label="Status" empty="Choose status" class="" />


        {{-- Submit --}}
        <div class="w-full border-t border-default-medium pt-4 mt-2 col-span-full">
            <x-ui.submit-button target="save" class="col-span-full">
                <span x-text="id ? 'Edit' : 'Create'"></span>
            </x-ui.submit-button>
        </div>

    </form>
</x-modal.layout>

<script>
    function dateFormat(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        return new Date(dateString).toLocaleString('en-US', options);
    }
</script>