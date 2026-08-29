<div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
    class="fixed inset-0 bg-black/50 z-10 sm:hidden">
</div>

<aside x-show="sidebarOpen" class="w-64 z-20 fixed top-0 h-screen"
    x-transition:enter="transition ease-out duration-200 origin-left" x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 origin-left"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

    <div
        class="overflow-y-auto px-3 h-full flex flex-col bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 space-y-2">

        {{-- Logo & Brand --}}
        <div
            class="p-2 pt-4 flex items-center border-b border-gray-200 dark:border-gray-700 justify-start sm:justify-center">

            <a href="/" wire:naviigate>
                <img src="{{ asset('img/logo.png') }}" alt="PT Properindo Enviro Tech"
                    class="h-24 object-contain -my-2">
            </a>

            {{-- Mobile Close Button --}}
            <div class="ml-auto md:hidden">
                <x-dashboard.side-button />
            </div>

        </div>


        {{-- Dashboard --}}
        <div class="py-4">

            <h5 class="px-2 text-xs font-semibold tracking-wider
                       text-gray-400 uppercase mb-2">
                Dashboard
            </h5>

            <ul class="nav-list space-y-1">

                {{-- Dashboard Karyawan --}}
                @can('supervisor')
                <li>
                    <x-dashboard.link href="/employees" routeActive="employees">

                        <x-slot:icon>
                            <x-icons.users size="26" />
                        </x-slot:icon>

                        Employee
                    </x-dashboard.link>
                </li>
                @endcan


                {{-- Dashboard Pekerjaan --}}
                <li>
                    <x-dashboard.link href="/" routeActive="/">

                        <x-slot:icon>
                            <x-icons.task size="26" />
                        </x-slot:icon>

                        Task
                    </x-dashboard.link>
                </li>

            </ul>
        </div>


        {{-- Data --}}
        <div class="pb-4">

            <h5 class="px-2 text-xs font-semibold tracking-wider
                       text-gray-400 uppercase mb-2">
                Data
            </h5>

            <ul class="nav-list space-y-1">

                {{-- Data Karyawan --}}
                @can('supervisor')
                <li>
                    <x-dashboard.link href="/data/employees" routeActive="data/employees*">

                        <x-slot:icon>
                            <x-icons.users size="26" />
                        </x-slot:icon>

                        Employee
                    </x-dashboard.link>
                </li>
                @endcan


                {{-- Data Pekerjaan --}}
                <li>
                    <x-dashboard.link href="/data/tasks" routeActive="data/tasks*">

                        <x-slot:icon>
                            <x-icons.task size="26" />
                        </x-slot:icon>

                        Task
                    </x-dashboard.link>
                </li>

            </ul>
        </div>


        {{-- User --}}
        <div class="pb-4">

            <ul class="nav-list space-y-1">

                {{-- Notifications --}}
                <li>
                    <x-dashboard.link href="/dashboard/notifications" routeActive="dashboard/notifications*">

                        <x-slot:icon>
                            <x-icons.notification size="26" />
                        </x-slot:icon>

                        <div class="flex items-center justify-between w-full">
                            <span>Notifications</span>

                            {{-- Notification Badge --}}
                            @if ($unreadNotifications ?? 0 > 0)
                            <span class="inline-flex items-center justify-center
                                           min-w-5 h-5 px-1 text-xs font-medium
                                           text-white bg-red-500 rounded-full">
                                {{ $unreadNotifications }}
                            </span>
                            @endif
                        </div>

                    </x-dashboard.link>
                </li>


                {{-- Profile --}}
                <li>
                    <x-dashboard.link href="/dashboard/profile" routeActive="dashboard/profile*">

                        <x-slot:icon>
                            <x-icons.user size="26" />
                        </x-slot:icon>

                        Profile
                    </x-dashboard.link>
                </li>

            </ul>
        </div>


        {{-- Logout --}}
        <div class="mt-auto pb-4">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="w-full flex items-center gap-3 rounded-lg
                           px-3 py-2.5 text-sm font-medium cursor-pointer
                           text-gray-700 dark:text-gray-300
                           hover:bg-gray-100 dark:hover:bg-gray-700
                           transition">

                    <x-icons.logout size="22" />

                    Logout
                </button>

            </form>

        </div>

    </div>
</aside>