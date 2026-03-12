<div class="w-full bg-[#0a0a0a] text-white overflow-x-hidden relative" x-data="{ loading: true }" x-init="setTimeout(() => { loading = false }, 1600)">


    {{-- ══════════════════════════════════════
        MINIMALIST EDITORIAL LOADING
     ══════════════════════════════════════ --}}
    <div x-show="loading" x-transition:leave="transition duration-1000 cubic-bezier(0.4, 0, 0.2, 1)"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[9999] bg-[#070708] flex flex-col items-center justify-center overflow-hidden"
        style="display:flex;">

        {{-- Subtle Center Content --}}
        <div class="relative flex flex-col items-center">

            {{-- Top Label --}}
            <div class="mb-12 overflow-hidden">
                <p class="text-[10px] font-bold uppercase tracking-[0.8em] text-white/20"
                    style="animation: fadeInOut 2s ease-in-out infinite;">
                    Initializing Portfolio
                </p>
            </div>

            {{-- Main Name: Relaxed Tracking --}}
            <div class="relative">
                <h1 class="text-xs md:text-sm font-light tracking-[1.5em] md:tracking-[2.5em] text-white uppercase leading-none pr-[-2.5em]"
                    style="animation: revealText 1.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;">
                    Reva Adhitya
                </h1>

                {{-- Ultra-thin Progress Line --}}
                <div class="absolute -bottom-8 left-1/2 -translate-x-1/2 w-24 h-[1px] bg-white/5 overflow-hidden">
                    <div class="h-full bg-white/40"
                        style="animation: slowLoad 2s cubic-bezier(0.4, 0, 0.2, 1) forwards;">
                    </div>
                </div>
            </div>

            {{-- Year Indicator --}}
            <div class="absolute bottom-[-100px] md:bottom-[-150px]">
                <span class="font-mono text-[9px] text-white/10 tracking-widest">© 2026</span>
            </div>
        </div>
    </div>

    <style>
        @keyframes revealText {
            0% {
                opacity: 0;
                letter-spacing: 3em;
                filter: blur(8px);
            }

            100% {
                opacity: 1;
                letter-spacing: 1.5em;
                filter: blur(0);
            }
        }

        @keyframes slowLoad {
            0% {
                width: 0%;
                transform: translateX(-100%);
            }

            100% {
                width: 100%;
                transform: translateX(0%);
            }
        }

        @keyframes fadeInOut {

            0%,
            100% {
                opacity: 0.1;
            }

            50% {
                opacity: 0.4;
            }
        }

        /* Khusus desktop tracking lebih lebar */
        @media (min-width: 768px) {
            @keyframes revealText {
                0% {
                    opacity: 0;
                    letter-spacing: 4em;
                    filter: blur(8px);
                }

                100% {
                    opacity: 1;
                    letter-spacing: 2.5em;
                    filter: blur(0);
                }
            }
        }
    </style>


    {{-- ══════════════════════════════════════
         HERO
    ══════════════════════════════════════ --}}
    <section id="home" class="relative min-h-[100svh] flex flex-col overflow-hidden bg-[#0a0a0a]">

        {{-- Vertical grid lines --}}
        <div class="absolute inset-0 pointer-events-none z-0 hidden md:flex justify-between px-[calc(50%-560px)]">
            @foreach ([0, 1, 2, 3, 4, 5] as $i)
                <div class="w-px h-full bg-white/[0.04]"></div>
            @endforeach
        </div>

        {{-- Hero image — right side cinematic --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute right-0 top-0 w-full md:w-[58%] h-full">
                <img src="{{ asset('storage/' . ($hero->image ?? 'default.jpg')) }}" alt="Profile"
                    class="w-full h-full object-cover object-top"
                    style="filter: grayscale(100%) contrast(1.1); animation: heroReveal 1.4s 1.5s cubic-bezier(0.16,1,0.3,1) both;">
                {{-- Gradient masks --}}
                <div class="absolute inset-0 bg-gradient-to-r from-[#0a0a0a] via-[#0a0a0a]/50 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-transparent to-[#0a0a0a]/40"></div>
            </div>
        </div>

        {{-- Social links --}}
        <div class="absolute left-6 md:left-10 bottom-32 z-20 hidden lg:flex flex-col items-center gap-4">
            <div class="w-px h-12 bg-white/10"></div>
            @foreach ($social_links as $link)
                <a href="{{ $link->url }}" target="_blank" data-magnetic
                    class="group w-8 h-8 border border-white/10 flex items-center justify-center
                           hover:border-white/60 hover:bg-white hover:scale-110
                           transition-all duration-300">
                    @if ($link->icon)
                        <img src="{{ asset('storage/' . $link->icon) }}"
                            class="w-3.5 h-3.5 object-contain opacity-30 group-hover:opacity-100 group-hover:brightness-0 transition-all">
                    @else
                        <span
                            class="text-[8px] font-bold text-white/30 group-hover:text-black uppercase leading-none transition-colors">
                            {{ substr($link->platform, 0, 2) }}
                        </span>
                    @endif
                </a>
            @endforeach
            <div class="w-px h-12 bg-white/10"></div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute right-8 bottom-12 z-20 hidden lg:flex flex-col items-center gap-3"
            style="animation: fadeIn 0.8s 2.2s ease-out both;">
            <span class="text-[8px] font-medium tracking-[0.4em] uppercase text-white/20 vertical-text"
                style="writing-mode:vertical-rl;">Scroll to explore</span>
            <div class="w-px h-10 bg-white/10 overflow-hidden">
                <div class="w-full h-1/2 bg-white/50" style="animation: scrollLine 2s ease-in-out infinite;"></div>
            </div>
        </div>

        {{-- Hero content --}}
        <div
            class="relative z-10 flex-1 flex flex-col justify-center md:justify-end
                    max-w-[1200px] mx-auto w-full px-6 md:px-12 pb-0 md:pb-28 pt-28 md:pt-0">

            {{-- Eyebrow --}}
            <div class="flex items-center gap-4 mb-8" style="animation: fadeIn 0.6s 1.6s ease-out both; opacity:0;">
                <div class="flex items-center gap-2">
                    <span class="relative flex h-1.5 w-1.5">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-50"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-white"></span>
                    </span>
                    <span class="text-[10px] font-medium tracking-[0.35em] uppercase text-white/40">Available for
                        projects</span>
                </div>
                <div class="h-px flex-1 max-w-[80px] bg-white/10"></div>
                <span class="text-[10px] font-medium tracking-[0.25em] uppercase text-white/20">Jakarta · 2026</span>
            </div>

            {{-- Main headline — split lines editorial --}}
            @php
                $titleParts = explode(' ', $hero->title ?? 'Reva Adhitya');
                $last = array_pop($titleParts);
                $first = implode(' ', $titleParts);
            @endphp

            <div class="mb-8">
                <div class="overflow-hidden">
                    <h1 class="text-[clamp(3.5rem,9vw,8.5rem)] font-black leading-[0.9] tracking-[-0.04em] text-white"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;
                               animation: slideUp 1s 1.7s cubic-bezier(0.16,1,0.3,1) both;">
                        {{ strtoupper($first) }}
                    </h1>
                </div>
                <div class="overflow-hidden flex items-end gap-4 md:gap-8">
                    <h1 class="text-[clamp(3.5rem,9vw,8.5rem)] font-black leading-[0.9] tracking-[-0.04em]"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif; color:transparent;
                               -webkit-text-stroke: 1.5px rgba(255,255,255,0.35);
                               animation: slideUp 1s 1.85s cubic-bezier(0.16,1,0.3,1) both;">
                        {{ strtoupper($last) }}
                    </h1>
                    <span
                        class="text-[clamp(1rem,2vw,1.5rem)] font-light tracking-[-0.01em] text-white/30 mb-3 hidden md:block"
                        style="animation: fadeIn 0.8s 2s ease-out both;">
                        — Creative Developer
                    </span>
                </div>
            </div>

            {{-- Subtitle + CTAs --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end max-w-4xl"
                style="animation: fadeIn 0.8s 2.1s ease-out both; opacity:0;">
                <p class="text-base md:text-lg text-white/40 leading-relaxed font-light max-w-xs">
                    {{ $hero->subtitle ?? 'I craft precise digital experiences with clarity & emotional impact.' }}
                </p>

                <div class="flex flex-col sm:flex-row items-start gap-3">
                    <a href="{{ $hero->cta_link ?? '#' }}" data-magnetic
                        class="group relative overflow-hidden inline-flex items-center gap-3 px-7 py-4 bg-white text-[#0a0a0a]
                               text-[11px] font-bold uppercase tracking-[0.2em]
                               hover:bg-white/90 active:scale-95 transition-all duration-200">
                        {{ $hero->cta_text ?? 'Start a Project' }}
                        <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>

                    <a href="/cv.pdf" download
                        class="group inline-flex items-center gap-3 px-7 py-4 border border-white/15 text-white/60
                               text-[11px] font-bold uppercase tracking-[0.2em]
                               hover:border-white/50 hover:text-white active:scale-95 transition-all duration-300">
                        <svg class="w-3.5 h-3.5 group-hover:translate-y-0.5 transition-transform" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        CV
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom stat bar --}}
        <div class="relative z-10 border-t border-white/[0.06] bg-[#0a0a0a]/80 backdrop-blur-md"
            style="animation: fadeIn 0.6s 2.3s ease-out both; opacity:0;">
            <div class="max-w-[1200px] mx-auto px-6 md:px-12">
                <div class="grid grid-cols-3 divide-x divide-white/[0.06]">
                    @foreach ([['40+', 'Projects delivered'], ['5+', 'Years experience'], ['100%', 'Client satisfaction']] as $stat)
                        <div
                            class="py-5 {{ $loop->first ? 'pr-8' : ($loop->last ? 'pl-8' : 'px-8') }} group cursor-default">
                            <p class="text-xl md:text-2xl font-black tracking-[-0.03em] text-white group-hover:text-white/60 transition-colors"
                                style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">{{ $stat[0] }}</p>
                            <p class="text-[9px] font-medium tracking-[0.2em] uppercase text-white/20 mt-0.5">
                                {{ $stat[1] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         MARQUEE STRIP
    ══════════════════════════════════════ --}}
    <div class="border-y border-white/[0.06] bg-[#0f0f0f] overflow-hidden py-4">
        <div class="flex gap-0 whitespace-nowrap" style="animation: marqueeScroll 24s linear infinite;">
            @foreach (range(1, 8) as $i)
                <span
                    class="inline-flex items-center gap-6 px-6 text-[11px] font-black tracking-[0.35em] uppercase text-white/10">
                    Web Design <span class="text-white/5">✦</span> 3D & Motion <span class="text-white/5">✦</span>
                    UI/UX <span class="text-white/5">✦</span> Development <span class="text-white/5">✦</span> Branding
                </span>
            @endforeach
        </div>
    </div>


    {{-- ══════════════════════════════════════
         FEATURED WORKS
    ══════════════════════════════════════ --}}
    @if ($projects->count() > 0)
        <section id="works" class="py-28 md:py-40 bg-[#0a0a0a]">
            <div class="max-w-[1200px] mx-auto px-6 md:px-12">

                {{-- Header --}}
                <div class="flex items-end justify-between mb-16 md:mb-20 aw-reveal">
                    <div>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-6 h-px bg-white/20"></div>
                            <span class="text-[9px] font-bold tracking-[0.4em] uppercase text-white/30">Selected
                                Works</span>
                        </div>
                        <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black tracking-[-0.04em] leading-[0.9] text-white"
                            style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                            CREATIVE<br>
                            <span
                                style="-webkit-text-stroke: 1px rgba(255,255,255,0.25); color: transparent;">HIGHLIGHTS.</span>
                        </h2>
                    </div>
                    <a href="{{ route('works') }}" wire:navigate
                        class="group hidden md:inline-flex items-center gap-2 text-[10px] font-bold tracking-[0.25em] uppercase text-white/30
                           hover:text-white transition-colors duration-300 border-b border-white/10 hover:border-white/50 pb-1">
                        All Projects
                        <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

                {{-- Swiper --}}
                <div class="swiper worksSwiper overflow-visible aw-reveal">
                    <div class="swiper-wrapper items-stretch">
                        @foreach ($projects as $project)
                            <div class="swiper-slide !h-auto">
                                <a href="{{ route('works.show', $project->slug) }}"
                                    class="group flex flex-col h-full">

                                    {{-- Image --}}
                                    <div class="relative overflow-hidden aspect-[4/3] mb-5 bg-[#111]">
                                        @php
                                            $displayImage = $project->cover_image ?? $project->image;
                                        @endphp
                                        @if ($displayImage)
                                            @php
                                                $fileUrl = Str::startsWith($displayImage, 'http')
                                                    ? $displayImage
                                                    : asset('storage/' . $displayImage);
                                                $ext = strtolower(pathinfo($displayImage, PATHINFO_EXTENSION));
                                                $isVideo = in_array($ext, ['mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv']);
                                            @endphp
                                            @if ($isVideo)
                                                <video src="{{ $fileUrl }}" muted loop playsinline autoplay
                                                    class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105"></video>
                                            @else
                                                <img src="{{ $fileUrl }}"
                                                    class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105">
                                            @endif
                                        @endif

                                        {{-- Scrim --}}
                                        <div
                                            class="absolute inset-0 bg-[#0a0a0a]/0 group-hover:bg-[#0a0a0a]/20 transition-colors duration-500">
                                        </div>

                                        {{-- View icon popup --}}
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div
                                                class="w-14 h-14 border border-white/80 flex items-center justify-center
                                                    opacity-0 group-hover:opacity-100 scale-50 group-hover:scale-100
                                                    transition-all duration-400 bg-white/5 backdrop-blur-sm">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                                </svg>
                                            </div>
                                        </div>

                                        {{-- Project number --}}
                                        <div
                                            class="absolute top-4 left-4 text-[9px] font-bold tracking-[0.3em] text-white/30">
                                            {{ str_pad($loop->index + 1, 2, '0', STR_PAD_LEFT) }}
                                        </div>
                                    </div>

                                    {{-- Meta --}}
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <h3
                                                class="text-base md:text-lg font-bold tracking-[-0.02em] text-white/80
                                                   group-hover:text-white transition-colors duration-200 mb-1">
                                                {{ $project->title }}
                                            </h3>
                                            <p class="text-xs text-white/25 line-clamp-1 font-light tracking-wide">
                                                {{ $project->description }}
                                            </p>
                                        </div>
                                        <div
                                            class="w-7 h-7 border border-white/10 flex items-center justify-center flex-shrink-0
                                                group-hover:border-white/60 group-hover:bg-white transition-all duration-300 mt-0.5">
                                            <svg class="w-3 h-3 text-white/30 group-hover:text-black transition-colors group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all duration-200"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Controls --}}
                <div class="flex items-center gap-4 mt-10 aw-reveal">
                    <button
                        class="works-prev group w-10 h-10 border border-white/10 flex items-center justify-center
                               hover:border-white/60 hover:bg-white active:scale-90 transition-all duration-200">
                        <svg class="w-4 h-4 text-white/40 group-hover:text-black transition-colors" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <div class="swiper-pagination-works flex items-center gap-2"></div>
                    <button
                        class="works-next group w-10 h-10 border border-white/10 flex items-center justify-center
                               hover:border-white/60 hover:bg-white active:scale-90 transition-all duration-200">
                        <svg class="w-4 h-4 text-white/40 group-hover:text-black transition-colors" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                    <a href="{{ route('works') }}" wire:navigate
                        class="md:hidden ml-auto text-[9px] font-bold tracking-[0.25em] uppercase text-white/30 hover:text-white border-b border-white/10 pb-0.5 transition-colors">
                        All →
                    </a>
                </div>
            </div>
        </section>
    @endif


    {{-- ══════════════════════════════════════
         FEATURED WEBSITES
    ══════════════════════════════════════ --}}
    @if ($websites->count() > 0)
        <section id="websites" class="py-28 md:py-40 bg-[#0f0f0f]">
            <div class="max-w-[1200px] mx-auto px-6 md:px-12">

                <div class="flex items-end justify-between mb-16 md:mb-20 aw-reveal">
                    <div>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-6 h-px bg-white/20"></div>
                            <span class="text-[9px] font-bold tracking-[0.4em] uppercase text-white/30">Web
                                Collection</span>
                        </div>
                        <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black tracking-[-0.04em] leading-[0.9] text-white"
                            style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                            WEBSITES<br>
                            <span
                                style="-webkit-text-stroke: 1px rgba(255,255,255,0.25); color: transparent;">COLLECTION.</span>
                        </h2>
                    </div>
                    <a href="{{ route('websites') }}" wire:navigate
                        class="group hidden md:inline-flex items-center gap-2 text-[10px] font-bold tracking-[0.25em] uppercase text-white/30
                           hover:text-white transition-colors border-b border-white/10 hover:border-white/50 pb-1">
                        All Sites
                        <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($websites as $i => $website)
                        <div class="aw-reveal" style="--delay:{{ $i * 80 }}ms">
                            <a href="{{ route('websites.show', $website->slug) }}"
                                class="group relative flex flex-col overflow-hidden bg-[#111] border border-white/[0.06]
                                   hover:border-white/25 transition-all duration-500
                                   hover:-translate-y-1 hover:shadow-[0_20px_60px_rgba(0,0,0,0.6)]">

                                {{-- Image --}}
                                <div class="relative overflow-hidden aspect-[4/3]">
                                    @if ($website->image)
                                        <img src="{{ asset('storage/' . $website->image) }}"
                                            class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105"
                                            style="filter: grayscale(70%); transition: filter 0.7s ease, transform 0.7s ease;"
                                            onmouseenter="this.style.filter='grayscale(0%)'"
                                            onmouseleave="this.style.filter='grayscale(70%)'">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-[#1a1a1a]">
                                            <span class="text-5xl font-black text-white/5"
                                                style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                                                {{ substr($website->title, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif

                                    {{-- Tags on hover --}}
                                    @if ($website->tags)
                                        <div
                                            class="absolute top-3 left-3 flex flex-wrap gap-1.5 opacity-0 group-hover:opacity-100 -translate-y-1 group-hover:translate-y-0 transition-all duration-300">
                                            @foreach (array_slice($website->tags, 0, 2) as $tag)
                                                <span
                                                    class="px-2.5 py-1 bg-[#0a0a0a]/90 backdrop-blur-sm border border-white/20
                                                         text-[8px] font-bold uppercase tracking-[0.15em] text-white/60">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                {{-- Card body --}}
                                <div class="p-5 flex items-start justify-between gap-3">
                                    <div class="flex-1 min-w-0">
                                        <h3
                                            class="text-sm font-bold tracking-[-0.01em] text-white/70 group-hover:text-white transition-colors duration-200 mb-1 truncate">
                                            {{ $website->title }}
                                        </h3>
                                        <p class="text-xs text-white/20 line-clamp-1 font-light">
                                            {{ $website->description }}</p>
                                    </div>
                                    <div
                                        class="w-7 h-7 border border-white/10 flex items-center justify-center flex-shrink-0
                                            group-hover:bg-white group-hover:border-white transition-all duration-300">
                                        <svg class="w-3 h-3 text-white/30 group-hover:text-black transition-colors"
                                            fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </div>
                                </div>

                                {{-- Bottom line sweep --}}
                                <div
                                    class="absolute bottom-0 left-0 h-px w-0 bg-white group-hover:w-full transition-all duration-700">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- ══════════════════════════════════════
         SERVICES
    ══════════════════════════════════════ --}}
    @if ($services->count() > 0)
        <section id="services" class="py-28 md:py-40 bg-[#0a0a0a]">
            <div class="max-w-[1200px] mx-auto px-6 md:px-12">

                <div class="mb-5 aw-reveal">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-6 h-px bg-white/20"></div>
                        <span class="text-[9px] font-bold tracking-[0.4em] uppercase text-white/30">What I Offer</span>
                    </div>
                    <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black tracking-[-0.04em] leading-[0.9] text-white mb-6"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                        SPECIALIZED<br>
                        <span
                            style="-webkit-text-stroke: 1px rgba(255,255,255,0.25); color: transparent;">SOLUTIONS.</span>
                    </h2>
                    <p class="text-base text-white/30 max-w-md leading-relaxed font-light">
                        I build digital solutions that simplify, streamline, and strengthen brands with precision and
                        purpose.
                    </p>
                </div>

                {{-- Service rows — editorial list --}}
                <div class="mt-16 border-t border-white/[0.06]" id="services-container">
                    @foreach ($services as $index => $service)
                        <div class="aw-reveal" style="--delay:{{ $index * 80 }}ms">
                            <a href="{{ route('services.show', $service->slug) }}"
                                class="group relative flex items-center justify-between gap-6 py-7 md:py-9 border-b border-white/[0.06]
                                   hover:bg-white/[0.02] transition-all duration-400 overflow-hidden px-0 hover:px-5">

                                {{-- BG image hint --}}
                                @if ($service->icon)
                                    <div class="absolute inset-0 pointer-events-none">
                                        <img src="{{ asset('storage/' . $service->icon) }}"
                                            class="absolute right-0 top-0 w-1/2 h-full object-cover opacity-0 group-hover:opacity-[0.5] scale-110 group-hover:scale-100 transition-all duration-700">
                                    </div>
                                @endif

                                <div class="flex items-center gap-8 flex-1 relative z-10 min-w-0">
                                    <span
                                        class="text-[10px] font-bold tracking-[0.3em] text-white/15 flex-shrink-0 w-6">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="text-xl md:text-2xl lg:text-3xl font-black tracking-[-0.03em] text-white/70
                                               group-hover:text-white transition-colors duration-300 truncate"
                                            style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                                            {{ strtoupper($service->title) }}
                                        </h3>
                                        <p
                                            class="text-xs text-white/20 leading-relaxed mt-1 max-w-sm font-light 
          max-h-0 opacity-0 overflow-hidden 
          group-hover:max-h-12 group-hover:opacity-100 group-hover:line-clamp-2 
          transition-all duration-500">
                                            {{ $service->description }}
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="relative z-10 w-9 h-9 border border-white/10 flex items-center justify-center flex-shrink-0
                                        group-hover:bg-white group-hover:border-white transition-all duration-300">
                                    <svg class="w-3.5 h-3.5 text-white/30 group-hover:text-black group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all duration-200"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </div>

                                {{-- Left accent bar --}}
                                <div
                                    class="absolute left-0 top-0 w-0 group-hover:w-px h-full bg-white transition-all duration-700">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- ══════════════════════════════════════
         FEATURES / WHY ME
    ══════════════════════════════════════ --}}
    @if ($features->count() > 0)
        <section id="features" class="py-28 md:py-40 bg-[#0f0f0f]">
            <div class="max-w-[1200px] mx-auto px-6 md:px-12">

                <div class="text-center max-w-2xl mx-auto mb-20 aw-reveal">
                    <div class="flex items-center justify-center gap-3 mb-5">
                        <div class="w-6 h-px bg-white/20"></div>
                        <span class="text-[9px] font-bold tracking-[0.4em] uppercase text-white/30">Why Work With
                            Me</span>
                        <div class="w-6 h-px bg-white/20"></div>
                    </div>
                    <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black tracking-[-0.04em] leading-[0.9] text-white"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                        DRIVEN BY<br>
                        <span
                            style="-webkit-text-stroke: 1px rgba(255,255,255,0.25); color: transparent;">PURPOSE.</span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="features-grid">
                    @foreach ($features as $index => $feature)
                        <div class="feature-card group relative p-8 md:p-10 border border-white/[0.07] bg-[#0a0a0a]
                                hover:border-white/20 hover:bg-[#111] hover:-translate-y-1
                                transition-all duration-400 overflow-hidden cursor-default
                                opacity-0 translate-y-8"
                            style="transition-delay: {{ $index * 70 }}ms;">

                            {{-- Number watermark --}}
                            <div class="absolute top-4 right-5 text-[2.5rem] font-black text-white/[0.03] leading-none select-none"
                                style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>

                            {{-- Icon --}}
                            <div
                                class="w-11 h-11 border border-white/[0.07] bg-[#111] flex items-center justify-center mb-8
                                    group-hover:bg-white group-hover:border-white transition-all duration-400">
                                @if ($feature->icon)
                                    <img src="{{ asset('storage/' . $feature->icon) }}"
                                        class="w-5 h-5 object-contain opacity-30 group-hover:opacity-100 group-hover:brightness-0 transition-all duration-300">
                                @else
                                    <span
                                        class="text-white/30 group-hover:text-black text-sm transition-colors">✦</span>
                                @endif
                            </div>

                            <h3
                                class="text-lg font-bold tracking-[-0.02em] text-white/70 mb-3
                                   group-hover:text-white transition-colors duration-200">
                                {{ $feature->title }}
                            </h3>
                            <p class="text-sm text-white/25 leading-relaxed font-light">
                                {{ $feature->description }}
                            </p>

                            {{-- Hover sweep --}}
                            <div
                                class="absolute bottom-0 left-0 h-px w-0 bg-white group-hover:w-full transition-all duration-700">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- ══════════════════════════════════════
         ABOUT
    ══════════════════════════════════════ --}}
    <section id="about" class="py-28 md:py-40 bg-[#0a0a0a] overflow-hidden">
        <div class="max-w-[1200px] mx-auto px-6 md:px-12">

            {{-- Big label background --}}
            <div class="absolute pointer-events-none select-none overflow-hidden" style="left:0; right:0;">
                <p class="text-[18vw] font-black text-white/[0.018] leading-none tracking-[-0.05em] text-center"
                    style="font-family:'Bebas Neue','Arial Black',sans-serif;">ABOUT</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center relative z-10">

                {{-- Image --}}
                <div class="aw-reveal order-2 lg:order-1">
                    <div class="group relative">
                        {{-- Decorative corner frames --}}
                        <div
                            class="absolute -top-3 -left-3 w-10 h-10 border-t border-l border-white/20 pointer-events-none">
                        </div>
                        <div
                            class="absolute -bottom-3 -right-3 w-10 h-10 border-b border-r border-white/20 pointer-events-none">
                        </div>

                        <div class="relative aspect-[3/4] overflow-hidden bg-[#111]">
                            @if ($about->image)
                                <img src="{{ asset('storage/' . $about->image) }}"
                                    class="w-full h-full object-cover object-top transition-all duration-1000 group-hover:scale-[1.04]"
                                    style="filter: grayscale(85%); transition: filter 1s ease, transform 1s ease;"
                                    onmouseenter="this.style.filter='grayscale(20%)'"
                                    onmouseleave="this.style.filter='grayscale(85%)'">
                            @else
                                <div class="w-full h-full bg-[#111]"></div>
                            @endif
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a]/50 via-transparent to-transparent">
                            </div>
                        </div>

                        {{-- Floating stat --}}
                        <div class="absolute -bottom-5 -right-5 px-6 py-4 bg-white shadow-2xl">
                            <p class="text-3xl font-black tracking-[-0.04em] text-[#0a0a0a]"
                                style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">40+</p>
                            <p class="text-[9px] font-bold uppercase tracking-[0.2em] text-[#0a0a0a]/40">Projects</p>
                        </div>
                    </div>

                    {{-- Facts row --}}
                    <div class="mt-12 grid grid-cols-2 gap-0 border border-white/[0.07]">
                        @foreach ([['Based in', 'Indonesia'], ['Status', 'Open to work']] as $f)
                            <div
                                class="p-4 {{ $loop->last ? '' : 'border-r border-white/[0.07]' }} hover:bg-white/[0.02] transition-colors">
                                <p class="text-[8px] font-bold uppercase tracking-[0.3em] text-white/20 mb-1">
                                    {{ $f[0] }}</p>
                                <p
                                    class="text-sm font-medium text-white/60 {{ $loop->last ? 'text-green-400' : '' }}">
                                    {{ $f[1] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Content --}}
                <div class="order-1 lg:order-2 aw-reveal" style="--delay:150ms">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-6 h-px bg-white/20"></div>
                        <span class="text-[9px] font-bold tracking-[0.4em] uppercase text-white/30">About Me</span>
                    </div>

                    <h2 class="text-[clamp(2.5rem,5vw,4rem)] font-black tracking-[-0.04em] leading-[0.9] text-white mb-8"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                        DESIGNING<br>
                        <span
                            style="-webkit-text-stroke: 1px rgba(255,255,255,0.25); color:transparent;">PRECISION.</span>
                    </h2>

                    <p class="text-lg md:text-xl text-white/60 leading-relaxed font-light mb-5">
                        {{ Str::before($about->description, '.') }}.
                    </p>
                    <p class="text-base text-white/25 leading-relaxed font-light mb-12">
                        {{ Str::after($about->description, '.') }}
                    </p>

                    {{-- Values --}}
                    <div class="grid grid-cols-2 gap-0 border border-white/[0.07] mb-10">
                        @foreach ([['Philosophy', 'Form follows function, but emotion leads the way.'], ['Location', 'Working globally, based in Indonesia.']] as $v)
                            <div
                                class="p-5 {{ $loop->last ? '' : 'border-r border-white/[0.07]' }} group hover:bg-white/[0.03] transition-colors duration-300">
                                <p class="text-[8px] font-bold uppercase tracking-[0.3em] text-white/20 mb-2">
                                    {{ $v[0] }}</p>
                                <p class="text-xs text-white/40 leading-relaxed">{{ $v[1] }}</p>
                            </div>
                        @endforeach
                    </div>

                    @if (isset($about->button_text) && $about->button_text)
                        <a href="{{ $about->button_link ?? '#' }}" class="group inline-flex items-center gap-5">
                            <div
                                class="w-12 h-12 border border-white/15 flex items-center justify-center
                                        group-hover:bg-white group-hover:border-white transition-all duration-400">
                                <svg class="w-4 h-4 text-white/40 group-hover:text-black group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all duration-300"
                                    fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </div>
                            <div>
                                <p
                                    class="text-[9px] font-bold uppercase tracking-[0.3em] text-white/20 group-hover:text-white/60 transition-colors mb-0.5">
                                    Next Step</p>
                                <p
                                    class="text-lg font-bold tracking-[-0.02em] text-white/70 group-hover:text-white transition-colors">
                                    {{ $about->button_text }}
                                </p>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         PRICING
    ══════════════════════════════════════ --}}
    <section id="pricing" class="py-28 md:py-40 bg-[#0f0f0f] overflow-hidden">
        <div class="max-w-[1200px] mx-auto px-6 md:px-12">

            <div class="text-center max-w-xl mx-auto mb-20 aw-reveal">
                <div class="flex items-center justify-center gap-3 mb-5">
                    <div class="w-6 h-px bg-white/20"></div>
                    <span class="text-[9px] font-bold tracking-[0.4em] uppercase text-white/30">Investment</span>
                    <div class="w-6 h-px bg-white/20"></div>
                </div>
                <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black tracking-[-0.04em] leading-[0.9] text-white"
                    style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                    READY TO<br>
                    <span style="-webkit-text-stroke: 1px rgba(255,255,255,0.25); color:transparent;">LEVEL UP?</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @foreach ($pricing_plans as $index => $plan)
                    @php $isMain = $index === 1; @endphp
                    <div class="aw-reveal" style="--delay:{{ $index * 100 }}ms">
                        <div
                            class="group relative flex flex-col h-full border overflow-hidden transition-all duration-400 hover:-translate-y-1
                                    {{ $isMain
                                        ? 'bg-white border-white shadow-[0_20px_60px_rgba(255,255,255,0.08)] hover:shadow-[0_30px_80px_rgba(255,255,255,0.12)]'
                                        : 'bg-[#0a0a0a] border-white/[0.07] hover:border-white/25 hover:shadow-[0_20px_60px_rgba(0,0,0,0.4)]' }}">

                            @if ($isMain)
                                <div class="px-8 pt-5 pb-0">
                                    <span class="text-[9px] font-bold uppercase tracking-[0.3em] text-black/40">Most
                                        Popular</span>
                                </div>
                            @endif

                            <div class="flex-1 flex flex-col p-8 {{ $isMain ? 'pt-4' : '' }}">
                                <div
                                    class="mb-8 pb-8 border-b {{ $isMain ? 'border-black/10' : 'border-white/[0.07]' }}">
                                    <h3 class="text-2xl font-black tracking-[-0.03em] mb-1
                                               {{ $isMain ? 'text-[#0a0a0a]' : 'text-white/70' }}"
                                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                                        {{ strtoupper($plan->name) }}
                                    </h3>
                                    <p class="text-3xl font-black tracking-[-0.04em] mb-3 {{ $isMain ? 'text-[#0a0a0a]' : 'text-white' }}"
                                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                                        {{ $plan->price }}
                                    </p>
                                    <p
                                        class="text-sm leading-relaxed font-light {{ $isMain ? 'text-black/50' : 'text-white/25' }}">
                                        {{ $plan->description }}
                                    </p>
                                </div>

                                <div class="mt-auto">
                                    <a href="{{ $plan->cta_link ?? '#' }}"
                                        class="block w-full text-center py-4 text-[10px] font-bold uppercase tracking-[0.2em] transition-all duration-200 active:scale-[0.98]
                                               {{ $isMain ? 'bg-[#0a0a0a] text-white hover:bg-[#1a1a1a]' : 'bg-white text-[#0a0a0a] hover:bg-white/90' }}">
                                        {{ $plan->cta_text ?? 'Get Started' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Custom --}}
            <div
                class="aw-reveal flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 p-7 border border-white/[0.07] bg-[#0a0a0a]">
                <div>
                    <p class="text-base font-bold tracking-[-0.01em] text-white/60 mb-0.5">Need a custom solution?</p>
                    <p class="text-xs text-white/20 font-light">If your project doesn't fit, let's build something
                        tailored.</p>
                </div>
                <a href="#contact"
                    class="group flex-shrink-0 inline-flex items-center gap-2 text-[10px] font-bold tracking-[0.25em] uppercase text-white/40
                           hover:text-white border-b border-white/10 hover:border-white/50 pb-0.5 transition-all whitespace-nowrap">
                    Contact for Custom Work
                    <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         TESTIMONIALS
    ══════════════════════════════════════ --}}
    <section id="testimonials" class="py-28 md:py-40 bg-[#0a0a0a]">
        <div class="max-w-[1200px] mx-auto px-6 md:px-12">

            <div class="flex items-end justify-between mb-16 md:mb-20 aw-reveal">
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-6 h-px bg-white/20"></div>
                        <span class="text-[9px] font-bold tracking-[0.4em] uppercase text-white/30">Social Proof</span>
                    </div>
                    <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black tracking-[-0.04em] leading-[0.9] text-white"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                        CLIENT<br>
                        <span
                            style="-webkit-text-stroke: 1px rgba(255,255,255,0.25); color:transparent;">FEEDBACK.</span>
                    </h2>
                </div>
            </div>

            <div class="swiper testimonialSwiper overflow-visible aw-reveal">
                <div class="swiper-wrapper items-stretch">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide !h-auto py-2">
                            <div
                                class="group h-full flex flex-col p-8 border border-white/[0.07] bg-[#0a0a0a]
                                        hover:border-white/20 hover:bg-[#111] hover:-translate-y-1
                                        transition-all duration-400 relative overflow-hidden">

                                {{-- Large quote --}}
                                <div class="absolute top-4 right-6 text-7xl font-black text-white/[0.04] leading-none select-none"
                                    style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">"</div>

                                {{-- Stars --}}
                                <div class="flex gap-1 mb-6">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-3.5 h-3.5 text-white/40 group-hover:text-white/70 transition-colors"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>

                                <p
                                    class="text-sm md:text-base text-white/40 leading-relaxed font-light italic mb-8 flex-1 relative z-10
                                          group-hover:text-white/60 transition-colors duration-300">
                                    "{{ $testimonial->content }}"
                                </p>

                                <div class="flex items-center gap-4 pt-5 border-t border-white/[0.07]">
                                    <div
                                        class="w-10 h-10 overflow-hidden bg-[#1a1a1a] border border-white/10 flex-shrink-0">
                                        @if ($testimonial->avatar)
                                            <img src="{{ asset('storage/' . $testimonial->avatar) }}"
                                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-white/20 text-sm font-bold">
                                                {{ substr($testimonial->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p
                                            class="text-sm font-bold tracking-[-0.01em] text-white/60 group-hover:text-white transition-colors">
                                            {{ $testimonial->name }}
                                        </p>
                                        <p class="text-[9px] font-bold uppercase tracking-[0.2em] text-white/20">
                                            {{ $testimonial->position ?? 'Client' }}
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="absolute bottom-0 left-0 h-px w-0 bg-white group-hover:w-full transition-all duration-700">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-4 mt-10 aw-reveal">
                <button
                    class="testi-prev group w-10 h-10 border border-white/10 flex items-center justify-center
                               hover:border-white/60 hover:bg-white active:scale-90 transition-all duration-200">
                    <svg class="w-4 h-4 text-white/30 group-hover:text-black transition-colors" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <div class="swiper-pagination-testimonials flex items-center gap-2"></div>
                <button
                    class="testi-next group w-10 h-10 border border-white/10 flex items-center justify-center
                               hover:border-white/60 hover:bg-white active:scale-90 transition-all duration-200">
                    <svg class="w-4 h-4 text-white/30 group-hover:text-black transition-colors" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>

            <div class="mt-20 pt-16 border-t border-white/[0.06]">
                <livewire:public.components.testimonial-form />
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         CONTACT
    ══════════════════════════════════════ --}}
    <section id="contact" class="py-28 md:py-40 bg-white">
        <div class="max-w-[1200px] mx-auto px-6 md:px-12">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-start">

                {{-- Left --}}
                <div class="aw-reveal">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-6 h-px bg-[#1a1a1a]/20"></div>
                        <span class="text-[9px] font-bold tracking-[0.4em] uppercase text-black/30">Get In Touch</span>
                    </div>
                    <h2 class="text-[clamp(3rem,7vw,6rem)] font-black tracking-[-0.05em] leading-[0.88] text-[#0a0a0a] mb-8"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                        LET'S<br>
                        <span style="-webkit-text-stroke: 1.5px rgba(0,0,0,0.25); color:transparent;">CONNECT.</span>
                    </h2>
                    <p class="text-base text-black/40 leading-relaxed font-light max-w-xs mb-12">
                        Ready to start your next project? I am currently available for new opportunities.
                    </p>

                    <div class="inline-flex items-center gap-3 px-5 py-3.5 border border-black/10 bg-[#f5f5f5]">
                        <div class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-black/40">Available for new
                            projects</span>
                    </div>
                </div>

                {{-- Form --}}
                <div class="aw-reveal" style="--delay:150ms">
                    @if (session()->has('message'))
                        <div class="mb-5 px-5 py-4 bg-[#f5f5f5] border border-black/10 text-sm text-black/60">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="sendMessage" class="space-y-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <input type="text" wire:model="name" placeholder="Your name" required
                                class="w-full px-5 py-4 bg-[#f5f5f5] border border-transparent text-[#0a0a0a] placeholder-black/25
                                       text-sm font-light tracking-[-0.01em]
                                       focus:outline-none focus:bg-white focus:border-black/20 transition-all duration-300">
                            <input type="email" wire:model="email" placeholder="Email address" required
                                class="w-full px-5 py-4 bg-[#f5f5f5] border border-transparent text-[#0a0a0a] placeholder-black/25
                                       text-sm font-light tracking-[-0.01em]
                                       focus:outline-none focus:bg-white focus:border-black/20 transition-all duration-300">
                        </div>
                        <input type="text" wire:model="subject" placeholder="Subject"
                            class="w-full px-5 py-4 bg-[#f5f5f5] border border-transparent text-[#0a0a0a] placeholder-black/25
                                   text-sm font-light tracking-[-0.01em]
                                   focus:outline-none focus:bg-white focus:border-black/20 transition-all duration-300">
                        <textarea wire:model="message" rows="5" placeholder="Tell me about your project..." required
                            class="w-full px-5 py-4 bg-[#f5f5f5] border border-transparent text-[#0a0a0a] placeholder-black/25
                                   text-sm font-light tracking-[-0.01em] resize-none
                                   focus:outline-none focus:bg-white focus:border-black/20 transition-all duration-300"></textarea>
                        <button type="submit"
                            class="w-full py-4 bg-[#0a0a0a] text-white text-[11px] font-bold uppercase tracking-[0.25em]
                                   hover:bg-[#1a1a1a] active:scale-[0.99] transition-all duration-200">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         STYLES
    ══════════════════════════════════════ --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');


        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(100%);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes loadbar {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes heroReveal {
            from {
                opacity: 0;
                transform: scale(1.06);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes marqueeScroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        @keyframes scrollLine {
            0% {
                transform: translateY(-100%);
            }

            50% {
                transform: translateY(200%);
            }

            100% {
                transform: translateY(200%);
            }
        }

        /* Reveal */
        .aw-reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1),
                transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
            transition-delay: var(--delay, 0ms);
        }

        .aw-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Feature cards */
        .feature-card {
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1),
                transform 0.7s cubic-bezier(0.16, 1, 0.3, 1),
                background-color 0.3s ease,
                border-color 0.3s ease,
                box-shadow 0.4s ease !important;
        }

        .feature-card.visible {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        /* Swiper pagination */
        .swiper-pagination-bullet {
            width: 5px !important;
            height: 5px !important;
            background: rgba(255, 255, 255, 0.15) !important;
            opacity: 1 !important;
            border-radius: 9999px !important;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
        }

        .swiper-pagination-bullet-active {
            background: rgba(255, 255, 255, 0.9) !important;
            width: 20px !important;
            border-radius: 9999px !important;
        }

        .swiper-pagination {
            position: static !important;
        }

        /* Cursor expand on hover */
        body.cursor-hover #cursor-ring {
            width: 52px !important;
            height: 52px !important;
            opacity: 0.6 !important;
        }

        body.cursor-hover #cursor-dot {
            opacity: 0 !important;
        }

        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 3px;
        }

        ::-webkit-scrollbar-track {
            background: #0a0a0a;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 9999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        ::selection {
            background: white;
            color: #0a0a0a;
        }
    </style>


    {{-- ══════════════════════════════════════
         SCRIPTS
    ══════════════════════════════════════ --}}
    <script>
        /* ── Custom cursor ───────────────── */
        (function() {
            const dot = document.getElementById('cursor-dot');
            const ring = document.getElementById('cursor-ring');
            if (!dot || !ring) return;

            let mx = 0,
                my = 0;
            document.addEventListener('mousemove', e => {
                mx = e.clientX;
                my = e.clientY;
                dot.style.left = mx + 'px';
                dot.style.top = my + 'px';
                ring.style.left = mx + 'px';
                ring.style.top = my + 'px';
            });

            document.querySelectorAll('a, button, [data-magnetic]').forEach(el => {
                el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
                el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
            });
        })();

        /* ── Page init ──────────────────── */
        function initPage() {
            initSwipers();
            initReveal();
        }

        document.addEventListener('DOMContentLoaded', initPage);
        document.addEventListener('livewire:navigated', initPage);

        /* ── Swipers ────────────────────── */
        function initSwipers() {
            if (document.querySelector('.worksSwiper')) {
                new Swiper('.worksSwiper', {
                    slidesPerView: 1.15,
                    spaceBetween: 14,
                    grabCursor: true,
                    speed: 700,
                    navigation: {
                        nextEl: '.works-next',
                        prevEl: '.works-prev'
                    },
                    pagination: {
                        el: '.swiper-pagination-works',
                        clickable: true
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1.5,
                            spaceBetween: 16
                        },
                        1024: {
                            slidesPerView: 2.3,
                            spaceBetween: 20
                        },
                        1280: {
                            slidesPerView: 2.6,
                            spaceBetween: 24
                        },
                    }
                });
            }

            if (document.querySelector('.testimonialSwiper')) {
                new Swiper('.testimonialSwiper', {
                    slidesPerView: 1.05,
                    spaceBetween: 12,
                    grabCursor: true,
                    speed: 700,
                    autoplay: {
                        delay: 5500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true
                    },
                    navigation: {
                        nextEl: '.testi-next',
                        prevEl: '.testi-prev'
                    },
                    pagination: {
                        el: '.swiper-pagination-testimonials',
                        clickable: true
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1.5,
                            spaceBetween: 14
                        },
                        1024: {
                            slidesPerView: 2.2,
                            spaceBetween: 16
                        },
                        1280: {
                            slidesPerView: 2.6,
                            spaceBetween: 20
                        },
                    }
                });
            }
        }

        /* ── Scroll reveal ──────────────── */
        function initReveal() {
            const reveals = document.querySelectorAll('.aw-reveal');
            const features = document.querySelectorAll('.feature-card');

            const io = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('visible');
                        io.unobserve(e.target);
                    }
                });
            }, {
                threshold: 0.07,
                rootMargin: '0px 0px -30px 0px'
            });

            reveals.forEach(el => io.observe(el));

            const fio = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        const idx = Array.from(features).indexOf(e.target);
                        e.target.style.transitionDelay = `${idx * 65}ms`;
                        e.target.classList.add('visible');
                        fio.unobserve(e.target);
                    }
                });
            }, {
                threshold: 0.08
            });

            features.forEach(el => fio.observe(el));
        }
    </script>
</div>
