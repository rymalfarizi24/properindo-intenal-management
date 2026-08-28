<div class="w-full mx-auto max-w-6xl">
    <x-title>My Profile</x-title>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        {{-- Profile Sidebar --}}
        <aside class="xl:col-span-1">
            <form wire:submit.prevent="changePhoto"
                class="h-full bg-white border border-default-medium rounded-base p-6 lg:p-8 flex flex-col items-center text-center">
                {{-- Profile Image --}}
                <div
                    class="mb-2 relative w-4/5 max-w-52 aspect-square rounded-full object-cover border-4 border-white shadow-sm ring-1 ring-default-medium overflow-hidden">
                    <input wire:model="img" name="img" id="img" type="file" accept="image/*" class="hidden">
                    {{-- Loading Indicator --}}
                    <div wire:loading.flex wire:target='img'
                        class="flex justify-center items-center bg-black/30 transition absolute w-full h-full cursor-pointer">
                        <div class="w-10 h-10 border-4 border-gray-300 border-t-slate-600 rounded-full animate-spin">
                        </div>
                    </div>
                    {{-- Label for Image Upload --}}
                    <label wire:loading.remove.flex wire:target='img' for="img"
                        class="flex justify-center items-center hover:bg-black/30 hover:opacity-100 opacity-0 transition duration-300 absolute w-full h-full cursor-pointer">
                        <div class="flex flex-col items-center gap-1 text-white">
                            <x-icons.pen size="28" />
                            <span class="text-xs font-medium">
                                Change Photo
                            </span>
                        </div>
                    </label>
                    @if ($img)
                    <img class="object-cover w-full h-full" src="{{ $img->temporaryUrl() }}" alt="Preview">
                    @elseif ($lastImg)
                    <img class="object-cover w-full h-full" src="{{ $lastImg }}" alt="{{ $name }}">
                    @else
                    <img class="object-cover w-full h-full" src="/img/person-logo.png" alt="Person Logo">
                    @endif
                </div>

                <x-form.error-validation name="img" />

                {{-- User Info --}}
                <div class="mt-5">
                    <h2 class="text-xl font-bold text-heading">
                        {{ $name }}
                    </h2>

                    <p class="mt-1 text-sm text-body">
                        {{ $email }}
                    </p>
                </div>

                {{-- Role --}}
                <span
                    class="inline-flex items-center gap-1.5 mt-4 px-3 py-1.5 text-xs font-medium rounded-full bg-emerald-600/10 text-emerald-700 border border-emerald-600/20">
                    {{ ucfirst($role) }}
                </span>

                <div class="w-full border-t border-default-medium pt-4 mt-auto">
                    <x-ui.submit-button target="changePhoto" type="submit">
                        Change Photo
                    </x-ui.submit-button>
                </div>

            </form>
        </aside>

        {{-- Profile Information --}}
        <section class="xl:col-span-2">
            <form wire:submit.prevent="changeProfile"
                class="bg-white border border-default-medium rounded-base p-6 lg:p-8 flex flex-col h-full">

                {{-- Header --}}
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-heading">
                        Profile Information
                    </h2>

                    <p class="mt-1 text-sm text-body">
                        Update your personal information and account details.
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
                    <x-form.input type="text" name="position" placeholder="Your position" label="Position"
                        bg="neutral" />
                    {{-- Role --}}
                    <x-form.select-input
                        :data="['employee' => 'Employee', 'admin' => 'Admin', 'supervisor' => 'Supervisor']" name="role"
                        label="Role" empty="Choose role" :selected="$role" />
                    {{-- Status --}}
                    <x-form.select-input :data="['0' => 'Inactive', '1' => 'Active']" name="status" label="Status"
                        empty="Choose status" :selected="$status" />

                </div>

                {{-- Save Button --}}
                <div class="mt-auto w-full border-t border-default-medium pt-4">
                    <x-ui.submit-button target="changeProfile" type="submit">
                        Change Profile
                    </x-ui.submit-button>
                </div>

            </form>
        </section>


        {{-- Security Section --}}
        <section id="security" class="bg-white border border-default-medium rounded-base p-6 lg:p-8 col-span-full">

            {{-- Header --}}
            <div class="mb-6">
                <h2 class="text-xl font-bold text-heading">
                    Security
                </h2>

                <p class="mt-1 text-sm text-body">
                    Update your password to keep your account secure.
                </p>
            </div>

            <form wire:submit.prevent="changePassword">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    {{-- Last Password --}}
                    <x-form.input-password x-ref="password" name="last_password" placeholder="Enter your last password"
                        label="Last Password" bg="neutral" />
                    {{-- New Password --}}
                    <x-form.input-password x-ref="password" name="new_password" placeholder="Enter your new password"
                        label="New Password" bg="neutral" />
                    {{-- Confirm Password --}}
                    <x-form.input-password name="confirm_password" placeholder="Confirm your new password"
                        label="Confirm Password" bg="neutral" />
                </div>

                <div class="w-full border-t border-default-medium pt-4 mt-4">
                    <x-ui.submit-button target="changePassword" type="submit">
                        Change Password
                    </x-ui.submit-button>
                </div>
            </form>

        </section>
    </div>
</div>