<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/webp" href="{{ asset('img/logo-only.webp') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap"
        rel="stylesheet" />
    <title>{{ $title ?? 'Properindo Internal App' }}</title>
</head>

<body class="h-full bg-gray-100">
    <main class="flex min-h-full">
        {{-- Form --}}
        <section class="w-full md:w-1/2 flex flex-col justify-center px-6 py-10 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img src="{{ asset('img/logo.webp') }}" alt="PT Properindo Enviro Tech"
                    class="mx-auto w-80 grayscale-50 mb-4">
                <h2 class="text-center text-2xl/9 font-bold tracking-tight text-gray-900">
                    Sign in to your account
                </h2>
            </div>
            <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">
                {{ $slot }}
            </div>
        </section>
        <section class="w-1/2 bg-center bg-cover hidden md:block"
            style="background-image: url('{{ asset('img/auth-img.webp') }}')">

        </section>
    </main>

</body>

</html>