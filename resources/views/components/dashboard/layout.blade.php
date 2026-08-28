<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap"
        rel="stylesheet" />
    <title>Halaman Home</title>
</head>

<body class="min-h-screen" x-data="{ sidebarOpen: !window.matchMedia('(max-width: 639px)').matches }">
    {{-- @yield('content') --}}
    <x-dashboard.header />
    <div class="flex h-full">
        <x-dashboard.sidebar />
        <main class="bg-gray-100 p-4 sm:px-6 lg:px-8 w-full h-full" :class="{ 'sm:ml-64 ml-0': sidebarOpen }">
            {{ $slot }}
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>
