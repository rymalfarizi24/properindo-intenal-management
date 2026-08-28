<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    {{-- favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo/logo-only.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap"
        rel="stylesheet" />
    <title>{{ $title ?? 'Artikula - Ruang Baca' }}</title>
    <meta name="description" content="@yield('meta_description', 'Artikula adalah ruang baca digital berisi artikel berkualitas.')">
</head>

{{ $slot }}

</html>
