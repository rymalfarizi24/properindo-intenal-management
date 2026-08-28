<div class="w-full mx-auto">
    <x-title>My Profile</x-title>

    <form wire:submit.prevent="save" class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Kolom Kiri: Foto Profil --}}
        <div class="lg:col-span-1">
            <div
                class="bg-white border border-default-medium rounded-base py-8 px-4 lg:px-8 flex flex-col items-center text-center gap-4">
                <div
                    class="-mb-3 relative w-4/5 max-w-52 aspect-square rounded-full object-cover border border-default-medium overflow-hidden">
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
                        <x-icons.pen size="50" class="text-slate-300" />
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

                <div>
                    <p class="text-lg font-semibold text-heading">{{ $name }}</p>
                    <p class="text-body">{{ $username }}</p>
                </div>

                @can('admin')
                <span
                    class="inline-block text-xs font-medium px-2.5 py-1 rounded-full bg-emerald-600/10 text-emerald-700 border border-emerald-600/20">
                    Administrator
                </span>
                @endcan

                <a href="#" wire:navigate
                    class="inline-flex items-center gap-1.5 text-sm font-medium text-emerald-600 hover:text-emerald-700 transition mt-2">
                    Ganti Password
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Kolom Kanan: Detail Profile --}}
        <div class="bg-white lg:col-span-2 gap-y-5 border-default-medium rounded-base py-8 px-4 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- Nama --}}
                <x-form.input type="text" name="name" placeholder="Your name" label="Name" bg="neutral"
                    class="col-span-full" />
                {{-- Username --}}
                <x-form.input type="text" name="username" placeholder="Your username" label="Username" bg="neutral" />
                {{-- Job --}}
                <x-form.input type="text" name="job" placeholder="Your job" label="Job" bg="neutral" />
                {{-- Email --}}
                <div class="col-span-full">
                    <label class="block mb-2.5 space-x-0.5 text-sm font-medium text-heading" for="email">
                        <span>Email</span>
                        @if ($email_verified)
                        <span
                            class="shrink-0 text-xs font-medium px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">
                            Verified
                        </span>
                        @else
                        <span
                            class="shrink-0 text-xs font-medium px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700">
                            Unverified
                        </span>
                        @endif
                    </label>
                    <div class="flex items-center gap-2">
                        <input wire:model="email" id="email" type="email"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600 block w-full shadow-xs placeholder:text-body p-2.5">

                    </div>
                    @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="mt-4 lg:mt-6 border-t border-default-medium">
                <x-ui.submit-button target="save,img" class="">
                    Save
                </x-ui.submit-button>
            </div>
        </div>
    </form>
</div>