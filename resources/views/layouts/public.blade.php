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

    <link rel="icon" type="image/png" href="/img/logo.png">
    <title>Reva Adhitya | Portfolio</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        #navbar {
            transition: padding 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                background-color 0.4s ease,
                backdrop-filter 0.4s ease,
                border-color 0.4s ease;
            will-change: padding, background-color, backdrop-filter;
        }

        .nav-scrolled {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
            background-color: rgba(11, 11, 13, 0.85) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        #mobile-menu {
            transition: transform 0.6s cubic-bezier(0.77, 0, 0.175, 1);
            will-change: transform;
        }

        #menu-toggle {
            z-index: 120 !important;
        }

        ::selection {
            background: #f97316;
            color: white;
        }

        .prose-chat ul {
            list-style-type: disc;
            margin-left: 1rem;
            margin-bottom: 0.5rem;
            color: #d1d5db;
        }

        .prose-chat ol {
            list-style-type: decimal;
            margin-left: 1rem;
            margin-bottom: 0.5rem;
            color: #d1d5db;
        }

        .prose-chat p {
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }

        @media (min-width: 768px) {
            .glass-panel {
                background: rgba(22, 22, 24, 0.7) !important;
                backdrop-filter: blur(16px) saturate(180%);
                -webkit-backdrop-filter: blur(16px) saturate(180%);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        }

        /* Custom Scrollbar for the whole page */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #0b0b0d;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .prose-chat a {
            color: #f97316;
            text-decoration: underline;
            font-weight: bold;
            transition: opacity 0.2s;
        }

        .prose-chat a:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body class="font-sans antialiased text-white bg-[#0b0b0d]">

    <!-- ================= NAVBAR ================= -->
    @php
        $navItems = \App\Models\NavigationItem::where('is_active', true)
            ->whereNull('parent_id')
            ->with([
                'children' => function ($query) {
                    $query->where('is_active', true)->orderBy('sort_order');
                },
            ])
            ->orderBy('sort_order')
            ->get();
    @endphp
    <nav id="navbar"
        class="fixed top-0 left-0 w-full z-[100] py-7 px-6 md:px-12 transition-all duration-300 pointer-events-none">
        <div class="max-w-9xl mx-auto flex justify-between items-center pointer-events-auto">

            <a href="/"
                class="relative lg:pr-10 z-[110] text-2xl font-black tracking-tighter group transition-transform duration-300 hover:scale-105">
                Reva<span class="text-orange-500 group-hover:animate-pulse">.</span>
            </a>

            <div class="hidden xl:flex items-center space-x-10">
                @forelse($navItems as $item)
                    @if ($item->children->isNotEmpty())
                        {{-- Dropdown Menu --}}
                        <div class="relative group" x-data="{ open: false }">
                            <button @mouseenter="open = true" @mouseleave="open = false"
                                class="flex items-center gap-1 text-[11px] font-semibold uppercase tracking-[0.3em] text-white/50 hover:text-orange-500 transition-colors py-2">
                                {{ $item->label }}
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2" @mouseenter="open = true"
                                @mouseleave="open = false"
                                class="absolute top-full left-0 mt-2 w-48 bg-[#1c1c1e] border border-white/10 rounded-xl overflow-hidden shadow-2xl z-[120]">
                                <div class="py-2">
                                    @foreach ($item->children as $child)
                                        <a href="{{ $child->url }}"
                                            class="block px-4 py-3 text-xs font-semibold text-white/70 hover:text-white hover:bg-white/5 transition-colors">
                                            {{ $child->label }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Regular Menu --}}
                        <a href="{{ $item->url }}"
                            class="text-[11px] font-semibold uppercase tracking-[0.3em] text-white/50 hover:text-orange-500 transition-colors">
                            {{ $item->label }}
                        </a>
                    @endif
                @empty
                    <a href="#works"
                        class="text-[11px] font-black uppercase tracking-[0.3em] text-white/50 hover:text-orange-500 transition-colors">Works</a>
                    <a href="#services"
                        class="text-[11px] font-black uppercase tracking-[0.3em] text-white/50 hover:text-orange-500 transition-colors">Services</a>
                    <a href="{{ route('websites') }}"
                        class="text-[11px] font-black uppercase tracking-[0.3em] text-white/50 hover:text-orange-500 transition-colors">Websites</a>
                    <a href="{{ route('three-d.gallery') }}"
                        class="text-[11px] font-black uppercase tracking-[0.3em] text-white/50 hover:text-orange-500 transition-colors">3D</a>
                    <a href="#about"
                        class="text-[11px] font-black uppercase tracking-[0.3em] text-white/50 hover:text-orange-500 transition-colors">About</a>
                @endforelse

            </div>

            <div class="hidden xl:flex items-center space-x-4">
                {{-- <livewire:public.components.music-player /> --}}
                <a href="/#contact"
                    class="px-8 py-3 rounded-full bg-white text-black text-[10px] font-black uppercase tracking-widest hover:bg-orange-500 hover:text-white transition-all duration-300">
                    Let's Talk
                </a>
            </div>

            <button id="menu-toggle" style="z-index: 120;"
                class="relative w-11 h-11 flex flex-col justify-center items-center focus:outline-none xl:hidden bg-white/5 rounded-full border border-white/10 transition-colors hover:bg-white/10">
                <span class="line block w-5 h-0.5 bg-white transition-all duration-300 pointer-events-none"
                    style="transform: translateY(-3px)"></span>
                <span class="line block w-5 h-0.5 bg-white transition-all duration-300 pointer-events-none"
                    style="transform: translateY(3px)"></span>
            </button>

        </div>
    </nav>

    <div id="mobile-menu"
        class="fixed inset-0 bg-[#0b0b0d] z-[105] flex flex-col justify-center items-center space-y-6 transform translate-x-full xl:hidden transition-transform duration-500 ease-in-out pointer-events-auto">
        <button id="mobile-menu-close" style="pointer-events: auto !important; z-index: 200 !important;"
            class="absolute top-7 right-6 w-11 h-11 flex flex-col justify-center items-center focus:outline-none bg-white/5 rounded-full border border-white/10 transition-colors hover:bg-white/10">
            <span class="block w-5 h-0.5 bg-white transform rotate-45 translate-y-[1px]"></span>
            <span class="block w-5 h-0.5 bg-white transform -rotate-45 -translate-y-[1px]"></span>
        </button>

        <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-[0.03]">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[40vw] font-black">MENU</div>
        </div>

        @forelse($navItems as $item)
            @if ($item->children->isNotEmpty())
                <div x-data="{ expanded: false }" class="text-center w-full">
                    <button @click="expanded = !expanded"
                        class="text-4xl md:text-5xl font-black tracking-tighter hover:text-orange-500 transition-all duration-300 flex items-center justify-center gap-3 w-full">
                        {{ $item->label }}
                        <svg class="w-6 h-6 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="expanded" x-collapse class="flex flex-col space-y-4 mt-4 bg-white/5 py-4 w-full">
                        @foreach ($item->children as $child)
                            <a href="{{ $child->url }}" class="text-2xl font-bold text-white/70 hover:text-white">
                                {{ $child->label }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ $item->url }}"
                    class="text-4xl md:text-5xl font-black tracking-tighter hover:text-orange-500 transition-all duration-300 active:scale-90">
                    {{ $item->label }}<span class="text-orange-500">.</span>
                </a>
            @endif
        @empty
            <a href="#works" class="text-5xl font-black tracking-tighter">Works</a>
        @endforelse
    </div>

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    @php
        $footerSettings = \App\Models\FooterSetting::first();
        $details = $footerSettings->social_links ?? [];
        $footerSocialLinks = \App\Models\SocialLink::where('is_active', true)->orderBy('sort_order')->get();
    @endphp

    <footer id="footer" class="relative bg-[#0b0b0d] pt-32 pb-12 overflow-hidden border-t border-white/5">
        <div
            class="absolute bottom-0 left-1/2 -translate-x-1/2 text-[25vw] font-black text-white/[0.02] select-none pointer-events-none leading-none">
            {{ $details['watermark_text'] ?? 'REVALDY' }}
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-16 md:gap-8 mb-24">
                <div class="md:col-span-5">
                    <a href="/" class="text-3xl font-black tracking-tighter mb-8 block group">
                        REVA<span class="text-orange-500 group-hover:animate-pulse">.</span>
                    </a>
                    <p class="text-white/40 text-lg leading-relaxed max-w-sm mb-10">
                        {{ $footerSettings->about_text ?? 'Crafting high-performance digital experiences that merge aesthetic precision with technical excellence.' }}
                    </p>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-3 h-3 rounded-full bg-green-500 animate-pulse shadow-[0_0_10px_rgba(34,197,94,0.5)]">
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest text-white/60">
                            {{ $details['availability_text'] ?? 'Available for projects' }}
                        </span>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <h4 class="text-orange-500 font-black text-[10px] uppercase tracking-[0.4em] mb-8">Navigation</h4>
                    <ul class="space-y-4">
                        @forelse($navItems as $item)
                            <li>
                                <a href="{{ $item->url }}"
                                    class="text-white/60 hover:text-orange-500 font-bold transition-colors">
                                    {{ $item->label }}
                                </a>
                            </li>
                        @empty
                            <li><a href="#works"
                                    class="text-white/60 hover:text-orange-500 font-bold transition-colors">Works</a>
                            </li>
                            <li><a href="#services"
                                    class="text-white/60 hover:text-orange-500 font-bold transition-colors">Expertise</a>
                            </li>
                            <li><a href="#about"
                                    class="text-white/60 hover:text-orange-500 font-bold transition-colors">My
                                    Story</a>
                            </li>
                        @endforelse
                    </ul>
                </div>

                <div class="md:col-span-4">
                    <h4 class="text-orange-500 font-black text-[10px] uppercase tracking-[0.4em] mb-8">Connect</h4>
                    @if ($details['email'] ?? false)
                        <a href="mailto:{{ $details['email'] }}"
                            class="text-xl font-bold mb-2 hover:text-orange-500 transition-colors cursor-pointer block">
                            {{ $details['email'] }}
                        </a>
                    @endif
                    @if ($details['phone'] ?? false)
                        <a href="tel:{{ str_replace(' ', '', $details['phone']) }}"
                            class="text-xl font-bold mb-8 hover:text-orange-500 transition-colors cursor-pointer block">
                            {{ $details['phone'] }}
                        </a>
                    @endif

                    <div class="flex flex-wrap gap-4">
                        @foreach ($footerSocialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank"
                                class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center group hover:bg-orange-500 hover:border-orange-500 transition-all duration-500">
                                @if ($link->icon)
                                    <img src="{{ asset('storage/' . $link->icon) }}"
                                        class="w-5 h-5 object-contain opacity-60 group-hover:brightness-0 transition-all">
                                @else
                                    <span
                                        class="text-[10px] font-black text-white group-hover:text-black">{{ substr($link->platform, 0, 2) }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div
                class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6 text-[10px] font-black text-white/20 uppercase tracking-[0.2em]">
                <div>&copy; {{ $footerSettings->copyright_text }}</div>
                <div class="flex gap-8">
                    <a href="{{ route('privacy-policy') }}" class="hover:text-white transition">Privacy</a>
                    <a href="{{ route('terms-of-service') }}" class="hover:text-white transition">Terms</a>
                </div>
            </div>
        </div>
    </footer>


    <livewire:chat-bot />

    <script>
        const navbar = document.getElementById('navbar');
        let isScrolled = false;

        window.addEventListener('scroll', () => {
            const scrollPos = window.scrollY > 30;
            if (scrollPos !== isScrolled) {
                isScrolled = scrollPos;
                if (isScrolled) {
                    navbar.classList.add('nav-scrolled');
                } else {
                    navbar.classList.remove('nav-scrolled');
                }
            }
        }, {
            passive: true
        });

        const toggle = document.getElementById('menu-toggle');
        const mobileClose = document.getElementById('mobile-menu-close');
        const menu = document.getElementById('mobile-menu');
        const lines = toggle.querySelectorAll('.line');
        let isOpen = false;

        function toggleMenu() {
            isOpen = !isOpen;
            if (isOpen) {
                menu.classList.remove('translate-x-full');
                menu.classList.add('translate-x-0');
                document.body.style.overflow = 'hidden';
                toggle.style.opacity = '0';
                toggle.style.pointerEvents = 'none';
            } else {
                menu.classList.add('translate-x-full');
                menu.classList.remove('translate-x-0');
                document.body.style.overflow = '';
                toggle.style.opacity = '1';
                toggle.style.pointerEvents = 'auto';
            }
        }

        toggle.addEventListener('click', toggleMenu);
        mobileClose.addEventListener('click', toggleMenu);

        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (isOpen) toggleMenu();
            });
        });
    </script>
    @livewireScripts
    @livewireScriptConfig
</body>

</html>
