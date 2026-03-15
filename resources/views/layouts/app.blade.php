<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    <title>Sofyan Abdul Fatih | Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Quill Editor -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #0b0b0d;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased bg-[#0b0b0d] text-white selection:bg-purple-500 selection:text-white" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- Mobile Header -->
        <header
            class="flex items-center justify-between h-16 bg-[#0b0b0d]/80 backdrop-blur-md border-b border-white/5 px-4 lg:hidden z-40 sticky top-0">
            <a href="{{ route('dashboard') }}"
                class="text-lg font-bold text-white tracking-tight flex items-center gap-2">
                <div
                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center text-white font-bold">
                    S</div>
                <span>Admin<span class="text-purple-500">.</span></span>
            </a>
            <button @click="sidebarOpen = !sidebarOpen"
                class="text-gray-400 focus:outline-none hover:text-white transition-colors p-2 rounded-lg hover:bg-white/5">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </header>

        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#0b0b0d] border-r border-white/5 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:fixed lg:top-0 lg:bottom-0 flex flex-col"
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">

            <div class="h-20 flex items-center px-8 border-b border-white/5 shrink-0">
                <a href="{{ route('dashboard') }}"
                    class="text-xl font-bold text-white tracking-tight flex items-center gap-3">
                    <div
                        class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center text-white font-bold shadow-lg shadow-purple-500/20">
                        FATIH</div>
                    <span>CMS</span>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 custom-scrollbar">
                <!-- Close Button (Mobile) -->
                <div class="lg:hidden flex justify-end mb-4 px-2">
                    <button @click="sidebarOpen = false"
                        class="text-gray-400 hover:text-white p-2 rounded-lg hover:bg-white/5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <a href="{{ route('dashboard') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 mb-1
                    {{ request()->routeIs('dashboard')
                        ? 'bg-purple-600 text-white shadow-inner shadow-white/5 border border-white/5'
                        : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    {{ __('Dashboard') }}
                </a>

                <div class="pt-6 pb-2">
                    <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Content Management</p>
                </div>

                @php
                    $navItems = [
                        [
                            'route' => 'admin.hero',
                            'label' => 'Hero Section',
                            'icon' =>
                                'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z',
                        ],
                        // [
                        //     'route' => 'admin.order-form',
                        //     'label' => 'Order Form',
                        //     'icon' =>
                        //         'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z',
                        // ],
                        // [
                        //     'route' => 'admin.orders.index',
                        //     'label' => 'Order List',
                        //     'icon' =>
                        //         'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z',
                        // ],
                        [
                            'route' => 'admin.about',
                            'label' => 'About',
                            'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                        ],
                        [
                            'route' => 'admin.services',
                            'label' => 'Services',
                            'icon' =>
                                'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                        ],
                        [
                            'route' => 'admin.projects',
                            'label' => 'Projects',
                            'icon' =>
                                'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                        ],
                        // [
                        //     'route' => 'admin.leads',
                        //     'label' => 'Leads',
                        //     'icon' =>
                        //         'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                        // ],
                        [
                            'route' => 'admin.features',
                            'label' => 'Features',
                            'icon' =>
                                'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
                        ],
                        [
                            'route' => 'admin.pricing',
                            'label' => 'Pricing',
                            'icon' =>
                                'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                        ],
                        [
                            'route' => 'admin.testimonials',
                            'label' => 'Testimonials',
                            'icon' =>
                                'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z',
                        ],
                        // [
                        //     'route' => 'admin.websites',
                        //     'label' => 'Websites',
                        //     'icon' =>
                        //         'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9',
                        // ],
                        [
                            'route' => 'admin.gallery',
                            'label' => 'Media Gallery',
                            'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z',
                        ],
                        // [
                        //     'route' => 'admin.three-d.index',
                        //     'label' => '3D Gallery',
                        //     'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                        // ],
                        // [
                        //     'route' => 'admin.music.index',
                        //     'label' => 'Music',
                        //     'icon' =>
                        //         'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3',
                        // ],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 mb-1
                        {{ request()->routeIs($item['route'])
                            ? 'bg-purple-600 text-white shadow-inner shadow-white/5 border border-white/5'
                            : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-500 group-hover:text-white' }}"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ $item['icon'] }}" />
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach

                <div class="pt-6 pb-2">
                    <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Settings</p>
                </div>

                @php
                    $settingsItems = [
                        ['route' => 'admin.footer', 'label' => 'Footer', 'icon' => 'M4 6h16M4 12h16M4 18h7'],
                        [
                            'route' => 'admin.social-links',
                            'label' => 'Social Links',
                            'icon' =>
                                'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1',
                        ],
                        ['route' => 'admin.navigation', 'label' => 'Navigation', 'icon' => 'M4 6h16M4 12h16M4 18h16'],
                        [
                            'route' => 'admin.messages',
                            'label' => 'Messages',
                            'icon' =>
                                'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v9a2 2 0 002 2z',
                        ],
                        // [
                        //     'route' => 'admin.ai-settings',
                        //     'label' => 'AI Settings',
                        //     'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                        // ],
                        [
                            'route' => 'admin.website-settings',
                            'label' => 'Website Settings',
                            'icon' =>
                                'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                        ],
                    ];
                @endphp

                @foreach ($settingsItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 mb-1
                        {{ request()->routeIs($item['route'])
                            ? 'bg-purple-600 text-white shadow-inner shadow-white/5 border border-white/5'
                            : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-500 group-hover:text-white' }}"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ $item['icon'] }}" />
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach

                <a href="{{ route('profile') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 mb-1
                    {{ request()->routeIs('profile')
                        ? 'bg-purple-600 text-white shadow-inner shadow-white/5 border border-white/5'
                        : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('profile') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('Profile') }}
                </a>

            </nav>

            <div class="p-4 border-t border-white/5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-2 text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-72 bg-[#0b0b0d]">
            <!-- Desktop Header -->
            <header class="hidden lg:flex items-center justify-between h-20 px-8 border-b border-white/5">
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">
                        @if (isset($header))
                            {{ $header }}
                        @else
                            Dashboard
                        @endif
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>
                </div>

                <div class="flex items-center ml-auto gap-4">
                    <a href="{{ route('home') }}" target="_blank"
                        class="flex items-center px-4 py-2 text-xs font-bold uppercase tracking-wider text-gray-400 hover:text-white border border-white/10 rounded-full hover:bg-white/5 transition-colors">
                        View Site
                        <svg class="w-3 h-3 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-3 p-1.5 pr-4 rounded-full border border-white/10 bg-zinc-900/40 hover:bg-zinc-800/60 hover:border-purple-500/30 transition-all duration-300 group shadow-lg shadow-black/20 focus:outline-none">

                            <!-- Avatar with Gradient & Status Ring -->
                            <div class="relative">
                                <div
                                    class="w-9 h-9 rounded-full bg-gradient-to-tr from-blue-600 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-md group-hover:scale-105 transition-transform duration-300 ring-2 ring-purple-500/20 group-hover:ring-purple-500/50">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <!-- Online Status Dot -->
                                <div
                                    class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-zinc-950 rounded-full shadow-sm">
                                </div>
                            </div>

                            <!-- User Details (Hidden on small mobile if needed) -->
                            <div class="text-left hidden sm:block">
                                <p
                                    class="text-[13px] font-bold text-white leading-none group-hover:text-purple-400 transition-colors">
                                    {{ Auth::user()->name }}
                                </p>
                                <p
                                    class="text-[9px] font-extrabold text-zinc-500 uppercase tracking-[0.1em] leading-none mt-1.5">
                                    Administrator
                                </p>
                            </div>

                            <!-- Animated Chevron Icon -->
                            <div class="ml-1 text-zinc-500 group-hover:text-white transition-colors">
                                <svg class="w-4 h-4 transition-transform duration-300 ease-in-out"
                                    :class="{ 'rotate-180 text-purple-500': open }" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-[#1c1c1e] border border-white/10 py-1 z-50 rounded-xl shadow-2xl shadow-black/50 overflow-hidden"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95">
                            <a href="{{ route('profile') }}"
                                class="block px-4 py-3 text-sm font-medium text-gray-400 hover:bg-white/5 hover:text-white transition-colors">
                                Profile Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}"
                                class="px-2 py-2 border-t border-white/5 hover:bg-white/5">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors group">
                                    <svg class="w-4 h-4 mr-3 text-gray-500 group-hover:text-purple-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#0b0b0d] p-4 lg:p-8">
                <div class="pb-10">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-black/80 backdrop-blur-sm lg:hidden">
        </div>
    </div>
    @livewireScripts
    @livewireScriptConfig
</body>

</html>
