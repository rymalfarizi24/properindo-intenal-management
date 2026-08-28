<div class="w-full mx-auto max-w-6xl">
    {{-- Profile Information --}}
    <section>
        <form wire:submit.prevent="createEmployee"
            class="bg-white border border-default-medium rounded-base p-6 lg:p-8 flex flex-col h-full">

            {{-- Header --}}
            <div class="mb-6">
                <h2 class="text-xl font-bold text-heading">
                    Create Employee
                </h2>

                <p class="mt-1 text-sm text-body">
                    Create a new employee account by filling out the form below.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Name --}}
                <x-form.input type="text" name="name" placeholder="Your name" label="Name" bg="neutral" />
                {{-- Email --}}
                <x-form.input type="text" name="email" placeholder="Your email" label="Email" bg="neutral" />
                {{-- Department --}}
                <x-form.input type="text" name="department" placeholder="Your department" label="Department"
                    bg="neutral" />
                {{-- Position --}}
                <x-form.input type="text" name="position" placeholder="Your position" label="Position" bg="neutral" />
                {{-- Role --}}
                <x-form.select-input
                    :data="['employee' => 'Employee', 'admin' => 'Admin', 'supervisor' => 'Supervisor']" name="role"
                    label="Role" empty="Choose role" :selected="$role" />
                {{-- Status --}}
                <x-form.select-input :data="['0' => 'Inactive', '1' => 'Active']" name="status" label="Status"
                    empty="Choose status" :selected="$status" />
                {{-- Create Password --}}
                <x-form.input-password name="password" placeholder="Enter your password" label="Password"
                    bg="neutral" />
                {{-- Confirm Password --}}
                <x-form.input-password name="confirm_password" placeholder="Confirm your password"
                    label="Confirm Password" bg="neutral" />

            </div>

            {{-- Save Button --}}
            <div class="mt-4 w-full border-t border-default-medium pt-4">
                <x-ui.submit-button target="createEmployee" type="submit">
                    Create Employee
                </x-ui.submit-button>
            </div>

        </form>
    </section>
</div>