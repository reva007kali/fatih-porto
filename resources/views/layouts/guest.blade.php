<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RHN7H3NJS9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-RHN7H3NJS9');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'REVA') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Essential for Livewire 3 --}}
    @livewireStyles
</head>

<body class="font-sans antialiased bg-[#09090b] text-zinc-200 selection:bg-orange-500/30 selection:text-orange-200">

    {{-- 
            We remove the default 'min-h-screen flex flex-col items-center' wrappers here 
            because the Login component already provides its own high-quality 
            centered layout and background effects.
        --}}
    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>
