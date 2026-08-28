<nav class="bg-gray-900 text-gray-100" x-data="{ isOpen: false }">
    <div class="flex items-center justify-between py-4 px-5 lg:px-8">
        {{-- Logo --}}
        <div class="flex md:flex-1">
            <a href="/" wire:navigate class="-m-1.5 p-1.5">
                <img src="{{ asset('img/logo/logo-only.png') }}" alt="Logo Artikula" class="h-10 w-auto grayscale-50" />
            </a>
        </div>
        {{-- Navigasi --}}
        <div class="hidden md:flex md:space-x-12 text-sm/6 font-semibold">
            <x-header.link href="/" :active="request()->is('/')">Home</x-header.link>
            <x-header.link href="/about" :active="request()->is('about')">About</x-header.link>
            <x-header.link href="/blogs" :active="request()->is('blogs')">Blogs</x-header.link>
            <x-header.link href="/contact" :active="request()->is('contact')">Contact</x-header.link>
        </div>

        <div class="hidden md:flex md:flex-1 md:justify-end md:items-center">
            @auth
            {{-- Profile --}}
            <div @click="isOpen = !isOpen" class="flex items-center mr-6 relative cursor-pointer">
                <span class="text-sm">{{ auth()->user()->username }}</span>
                <div class="ml-3 mr-0.5 h-9 w-9 overflow-hidden rounded-full" type="button">
                    <img src="{{ asset('img/person-logo.png') }}" alt="my-logo" />
                </div>
                <x-icons.dropdown-line size="20" />

                <!-- Dropdown menu -->
                <div x-show="isOpen" x-on:click.outside="isOpen = false" x-cloak
                    x-transition:enter="transition ease-out duration-200 origin-top-right"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200 origin-top-right"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    class="absolute md:block hidden bg-slate-100 top-11 right-0 rounded-md z-10 w-44 border shadow-lg">
                    <ul class="text-body p-2 text-sm font-medium nav-list">
                        <li class="hover:bg-gray-200">
                            <a href="/dashboard" class="inline-flex w-full items-center rounded p-2">My Dashboard</a>
                        </li>
                        <li class="hover:bg-gray-200">
                            <a href="/profile" class="inline-flex w-full items-center rounded p-2">My Profile</a>
                        </li>
                        <hr class="h-2 text-gray-300">
                        <li class="hover:bg-gray-200 rounded-md group">
                            <x-header.sign-out-button />
                        </li>
                    </ul>
                </div>
            </div>
            {{-- Login --}}
            @else
            <a href="/sign-in" class="md:inline-flex items-center hidden font-semibold group text-sm">Sign
                in
                <x-icons.arrow size='15' class="group-hover:translate-x-1 inline-block transition ml-1" />
            </a>
            @endauth
        </div>

        {{-- Ketika layar small --}}

        {{-- Hamburger menu --}}
        <div class="flex md:hidden">
            <button @click="isOpen = !isOpen" type="button"
                class="-m-2.5 inline-flex cursor-pointer items-center justify-center rounded-md p-2.5 text-gray-100">
                <x-icons.hamburger size="24" />
            </button>
        </div>
    </div>

    {{-- Sidebar --}}
    <aside x-show="isOpen" x-on:click.outside="isOpen = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-50 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-50 translate-x-full"
        class="fixed md:hidden block inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <a href="/" class="block w-fit mx-auto">
            <img src="{{ asset('img/logo/logo-name.png') }}" alt="Logo Artikula" class="h-28 w-auto grayscale-50" />
        </a>
        <button type="button" @click="isOpen = false"
            class="absolute top-4 right-4 cursor-pointer rounded-md p-1 text-gray-700 hover:bg-gray-50">
            <x-icons.cross size="24" />
        </button>
        <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
                <div class="space-y-2 py-6">
                    <x-header.sidelink href="/" :active="request()->is('/')">Home</x-header.sidelink>
                    <x-header.sidelink href="/about" :active="request()->is('about')">About</x-header.sidelink>
                    <x-header.sidelink href="/blogs" :active="request()->is('blogs')">Blogs</x-header.sidelink>
                    <x-header.sidelink href="/contact" :active="request()->is('contact')">Contact</x-header.sidelink>
                </div>
                @auth
                <div class="py-6">
                    <!-- Profile Image -->
                    <div class="flex space-x-5">
                        <div class="h-12 w-12 overflow-hidden rounded-full ring-2">
                            <img src="/img/person-logo.png" alt="my-logo" />
                        </div>
                        <div class="">
                            <h5 class="text-gray-900">{{ auth()->user()->username }}</h5>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <!-- Profile Navigation -->
                    <div class="space-y-2 mt-6">
                        <x-header.sidelink href="/dashboard" :active="request()->is('dashoard')">My Dashboard
                        </x-header.sidelink>
                        <x-header.sidelink href="/profile" :active="request()->is('profile')">My Profile
                        </x-header.sidelink>
                    </div>
                </div>
                @endauth
                <div class="py-6">
                    @auth
                    <form action="/sign-out" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex cursor-pointer text-gray-900 hover:bg-gray-50 -mx-3 rounded-lg px-3 py-2 font-medium">Sign
                            Out</button>
                    </form>
                    @else
                    <a wire:navigate.hover href="/sign-in"
                        class="text-gray-900 hover:bg-gray-50 -mx-3 block rounded-lg px-3 py-2 font-medium">Sign
                        In</a>
                    @endauth
                </div>
            </div>
        </div>
    </aside>

</nav>