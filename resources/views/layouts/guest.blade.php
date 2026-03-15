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

    <link rel="icon" type="image/png"
        href="{{ ($fav = \App\Models\WebsiteSetting::first()?->favicon) ? asset('storage/' . $fav) : asset('img/logo.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Essential for Livewire 3 --}}
    @livewireStyles
</head>

<body class="font-sans antialiased bg-[#0b0b0d] text-gray-100 selection:bg-purple-500/30 selection:text-purple-200">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">

        {{-- Background Elements --}}
        <div class="absolute inset-0 z-0">
            <div
                class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-purple-600/20 rounded-full blur-[120px] animate-pulse-slow">
            </div>
            <div
                class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-600/10 rounded-full blur-[120px] animate-pulse-slow delay-1000">
            </div>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl rounded-2xl relative z-10">
            <div class="flex justify-center mb-8">
                <a href="/" wire:navigate class="group flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-purple-500/20 group-hover:scale-110 transition-transform duration-300">
                        F
                    </div>
                    <span
                        class="text-xl font-bold tracking-tight text-white group-hover:text-purple-400 transition-colors">FATIH</span>
                </a>
            </div>

            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>

</html>
