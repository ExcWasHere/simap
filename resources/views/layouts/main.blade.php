<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="max-[8192px]:opacity-0 max-[3120px]:opacity-100 max-[3120px]:m-0 max-[3120px]:p-0 max-[3120px]:box-border max-[3120px]:[font-family:'Plus_Jakarta_Sans',Times,sans-serif,serif] max-[324px]:hidden">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index" />
    <meta name="description" content="@yield('deskripsi')" />
    <meta property="og:title" content="@yield('judul') | SIMAP" />
    <meta property="og:description" content="@yield('deskripsi')" />
    <meta property="og:image" content="{{ asset('favicon.ico') }}" />
    <meta name="twitter:title" content="@yield('judul') | SIMAP" />
    <meta name="twitter:description" content="@yield('deskripsi')" />
    <meta name="twitter:image" content="{{ asset('favicon.ico') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('judul') | SIMAP</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js" integrity="sha512-H6cPm97FAsgIKmlBA4s774vqoN24V5gSQL4yBTDOY2su2DeXZVhQPxFK4P6GPdnZqM9fg1G3cMv5wD7e6cFLZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">
    @include('shared.ui.loader')
    @include('shared.navigation.header')

    <main class="flex-grow @if(!(Route::is(['masuk', 'lupa-kata-sandi', 'reset-kata-sandi']) || Request::route('token'))) container mx-auto px-4 py-6 @endif">
        @yield('konten')
    </main>

    @include('shared.navigation.footer')
    @include('shared.ui.modal-tambah')
    @include('shared.ui.modal-filter')

    @stack('skrip')
</body>

</html>