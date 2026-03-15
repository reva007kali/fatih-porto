<div class="w-full bg-[#050507] text-white overflow-x-hidden relative" x-data="{ loading: true }" x-init="setTimeout(() => { loading = false }, 1600)">

    {{-- ══════════════════════════════════════
         LOADER
    ══════════════════════════════════════ --}}
    <div x-show="loading" x-transition:leave="transition duration-700 cubic-bezier(0.4, 0, 0.2, 1)"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[9999] bg-[#050507] flex flex-col items-center justify-center overflow-hidden"
        style="display:flex;">
        <div class="relative w-full max-w-[1000px] mx-auto px-8 md:px-16 flex flex-col gap-10">
            <p class="text-[10px] font-bold uppercase tracking-[0.7em] text-white/25"
                style="animation: fadeUp 0.6s ease forwards; opacity:0; animation-delay:0.1s;">
                Initializing Portfolio
            </p>
            <h1 class="font-black uppercase leading-none tracking-[-0.04em] text-[clamp(4rem,16vw,12rem)]"
                style="font-family:'Bebas Neue','Arial Black',sans-serif;
                   background: linear-gradient(135deg, #67e8f9 0%, #818cf8 40%, #a78bfa 70%, #34d399 100%);
                   -webkit-background-clip: text;
                   -webkit-text-fill-color: transparent;
                   background-clip: text;
                   animation: fadeUp 0.8s cubic-bezier(0.16,1,0.3,1) forwards;
                   opacity:0; animation-delay:0.25s;">
                Sofyan Abdul<br>Fatih
            </h1>
            <div style="animation: fadeUp 0.6s ease forwards; opacity:0; animation-delay:0.4s;">
                <div class="relative w-full h-[2px] bg-white/[0.05] rounded-full overflow-hidden">
                    <div id="loader-bar" class="absolute top-0 left-0 h-full"
                        style="width:0%; transition: width 0.1s linear; background: linear-gradient(90deg, #67e8f9, #818cf8, #a78bfa, #34d399);">
                    </div>
                    <div id="loader-tip" class="absolute top-1/2 -translate-y-1/2 w-3 h-3 rounded-full -translate-x-1/2"
                        style="left:0%; background: #a78bfa; box-shadow: 0 0 16px 6px rgba(167,139,250,0.6); transition: left 0.1s linear;">
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-[9px] font-mono text-white/20 tracking-[0.3em] uppercase">Initializing
                        Studio</span>
                    <span id="loader-pct" class="text-[11px] font-mono font-bold tracking-[0.1em]"
                        style="color:#a78bfa;">0%</span>
                </div>
            </div>
            <span class="font-mono text-[9px] text-white/15 tracking-[0.4em]"
                style="animation: fadeUp 0.6s ease forwards; opacity:0; animation-delay:0.55s;">
                © 2026
            </span>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

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

        @keyframes auroraFloat {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -20px) scale(1.05);
            }

            66% {
                transform: translate(-20px, 10px) scale(0.97);
            }
        }

        @keyframes auroraFloat2 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(-40px, 30px) scale(1.08);
            }

            66% {
                transform: translate(20px, -15px) scale(0.95);
            }
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.4;
            }

            50% {
                opacity: 0.7;
            }
        }

        .aw-reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1), transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
            transition-delay: var(--delay, 0ms);
        }

        .aw-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-card {
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.4s ease !important;
        }

        .feature-card.visible {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        .swiper-pagination-bullet {
            width: 5px !important;
            height: 5px !important;
            background: rgb(226, 226, 226) !important;
            opacity: 1 !important;
            border-radius: 9999px !important;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
        }

        .swiper-pagination-bullet-active {
            background: rgba(103, 232, 249, 0.9) !important;
            width: 20px !important;
            border-radius: 9999px !important;
        }

        .swiper-pagination {
            position: static !important;
        }

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
            background: #050507;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 9999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        ::selection {
            background: #67e8f9;
            color: #050507;
        }

        .aurora-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }

        .bento-card {
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.07);
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
            position: relative;
        }

        .bento-card:hover {
            border-color: rgba(103, 232, 249, 0.2);
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-3px);
            box-shadow: 0 20px 60px rgba(103, 232, 249, 0.06);
        }

        .bento-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            padding: 1px;
            background: linear-gradient(135deg, rgba(103, 232, 249, 0.15) 0%, transparent 50%, rgba(167, 139, 250, 0.1) 100%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.4s;
        }

        .bento-card:hover::before {
            opacity: 1;
        }

        .gradient-text-aurora {
            background: linear-gradient(135deg, #67e8f9 0%, #818cf8 40%, #a78bfa 70%, #34d399 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-primary {
            background: linear-gradient(135deg, #67e8f9, #818cf8);
            color: #050507;
            font-weight: 700;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 28px;
            font-size: 11px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(103, 232, 249, 0.25);
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 12px 40px rgba(103, 232, 249, 0.35);
        }

        .btn-primary:active {
            transform: scale(0.98);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.7);
            font-weight: 700;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 28px;
            font-size: 11px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .btn-ghost {
            background: rgba(103, 232, 249, 0.08);
            border: 1px solid rgba(103, 232, 249, 0.2);
            color: #67e8f9;
            font-weight: 700;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            font-size: 10px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-ghost:hover {
            background: rgba(103, 232, 249, 0.15);
            box-shadow: 0 0 24px rgba(103, 232, 249, 0.15);
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: rgba(103, 232, 249, 0.08);
            border: 1px solid rgba(103, 232, 249, 0.15);
            border-radius: 100px;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: #67e8f9;
        }
    </style>

    <script>
        (function() {
            let pct = 0,
                animId = null;

            function update() {
                const bar = document.getElementById('loader-bar');
                const tip = document.getElementById('loader-tip');
                const label = document.getElementById('loader-pct');
                if (!bar || !tip || !label) return;
                const speed = pct < 70 ? 0.55 : pct < 90 ? 0.22 : 0.08;
                pct = Math.min(pct + speed, 100);
                bar.style.width = pct + '%';
                tip.style.left = pct + '%';
                label.textContent = Math.floor(pct) + '%';
                if (pct < 100) animId = requestAnimationFrame(update);
            }
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => requestAnimationFrame(update), 500);
                const loader = document.querySelector('[x-show="loading"]');
                if (loader) {
                    new MutationObserver((_, obs) => {
                        if (loader.style.display === 'none') {
                            cancelAnimationFrame(animId);
                            obs.disconnect();
                        }
                    }).observe(loader, {
                        attributes: true,
                        attributeFilter: ['style']
                    });
                }
            });
        })();
    </script>


    {{-- ══════════════════════════════════════
         HERO
    ══════════════════════════════════════ --}}
    <section id="home"
        class="relative min-h-[100svh] flex flex-col justify-center items-center overflow-hidden bg-[#050507]">

        {{-- Aurora background blobs --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="aurora-blob w-[700px] h-[700px] opacity-[0.12]"
                style="background: radial-gradient(circle, #67e8f9, transparent 70%); top: -200px; left: -200px; animation: auroraFloat 12s ease-in-out infinite;">
            </div>
            <div class="aurora-blob w-[600px] h-[600px] opacity-[0.10]"
                style="background: radial-gradient(circle, #818cf8, transparent 70%); top: 20%; right: -150px; animation: auroraFloat2 15s ease-in-out infinite;">
            </div>
            <div class="aurora-blob w-[500px] h-[500px] opacity-[0.08]"
                style="background: radial-gradient(circle, #34d399, transparent 70%); bottom: -100px; left: 30%; animation: auroraFloat 18s ease-in-out infinite reverse;">
            </div>
            <div class="aurora-blob w-[400px] h-[400px] opacity-[0.07]"
                style="background: radial-gradient(circle, #a78bfa, transparent 70%); top: 40%; left: 20%; animation: auroraFloat2 20s ease-in-out infinite;">
            </div>
        </div>

        {{-- Hero image --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute right-0 top-0 w-full h-full">
                <img src="{{ asset('storage/' . ($hero?->image ?? 'default.jpg')) }}" alt="Profile"
                    class="w-full h-full object-cover object-top"
                    style="animation: heroReveal 1.4s 1.5s cubic-bezier(0.16,1,0.3,1) both;">
                {{-- <div class="absolute inset-0 bg-gradient-to-r from-[#050507] via-[#050507]/60 to-transparent"></div> --}}
                <div class="absolute inset-0 bg-gradient-to-t from-[#050507] via-transparent to-[#050507]/50"></div>
            </div>
        </div>

        {{-- Social links --}}
        <div class="absolute left-6 md:left-10 bottom-32 z-20 hidden lg:flex flex-col items-center gap-4">
            <div class="w-px h-12 bg-white/10"></div>
            @foreach ($social_links as $link)
                <a href="{{ $link->url }}" target="_blank" data-magnetic
                    class="group w-8 h-8 border border-white/10 rounded-lg flex items-center justify-center
                           hover:border-cyan-400/50 hover:bg-cyan-400/10
                           transition-all duration-300">
                    @if ($link->icon)
                        <img src="{{ asset('storage/' . $link->icon) }}"
                            class="w-3.5 h-3.5 object-contain opacity-30 group-hover:opacity-80 transition-all">
                    @else
                        <span
                            class="text-[8px] font-bold text-white/30 group-hover:text-cyan-400 uppercase leading-none transition-colors">
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
            <span class="text-[8px] font-medium tracking-[0.4em] uppercase text-white/20"
                style="writing-mode:vertical-rl;">Scroll to explore</span>
            <div class="w-px h-10 bg-white/10 overflow-hidden">
                <div class="w-full h-1/2 bg-white/50" style="animation: scrollLine 2s ease-in-out infinite;"></div>
            </div>
        </div>

        {{-- Hero content --}}
        <div
            class="relative z-10 flex-1 flex flex-col justify-center items-center text-center max-w-[1200px] mx-auto w-full px-6 md:px-12">

            <div class="flex flex-col md:flex-row items-center justify-center gap-4 mb-8 w-full"
                style="animation: fadeIn 0.6s 1.6s ease-out both; opacity:0;">
                <div class="flex items-center gap-2">
                    <span class="relative flex h-1.5 w-1.5">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-50"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-cyan-400"></span>
                    </span>
                    <span class="text-[10px] font-medium tracking-[0.35em] uppercase text-white/40">Available for
                        projects</span>
                </div>
                <div class="hidden md:block h-px w-12 bg-white/10"></div>
                <span class="text-[10px] font-medium tracking-[0.25em] uppercase text-white/20">Jakarta · 2026</span>
            </div>

            <div class="mb-6 flex flex-col items-center gap-6">
                <div class="relative group cursor-crosshair">
                    {{-- Photoshop Bounding Box --}}
                    <div class="relative inline-block px-6 py-3 border border-white/40">
                        {{-- Corner Handles --}}
                        <div
                            class="absolute -top-1.5 -left-1.5 w-2.5 h-2.5 bg-white border border-black/30 shadow-sm z-20">
                        </div>
                        <div
                            class="absolute -top-1.5 -right-1.5 w-2.5 h-2.5 bg-white border border-black/30 shadow-sm z-20">
                        </div>
                        <div
                            class="absolute -bottom-1.5 -left-1.5 w-2.5 h-2.5 bg-white border border-black/30 shadow-sm z-20">
                        </div>
                        <div
                            class="absolute -bottom-1.5 -right-1.5 w-2.5 h-2.5 bg-white border border-black/30 shadow-sm z-20">
                        </div>

                        {{-- Midpoint Handles --}}
                        <div
                            class="absolute top-1/2 -left-1.5 w-2.5 h-2.5 bg-white border border-black/30 shadow-sm z-20 -translate-y-1/2">
                        </div>
                        <div
                            class="absolute top-1/2 -right-1.5 w-2.5 h-2.5 bg-white border border-black/30 shadow-sm z-20 -translate-y-1/2">
                        </div>
                        <div
                            class="absolute -top-1.5 left-1/2 w-2.5 h-2.5 bg-white border border-black/30 shadow-sm z-20 -translate-x-1/2">
                        </div>
                        <div
                            class="absolute -bottom-1.5 left-1/2 w-2.5 h-2.5 bg-white border border-black/30 shadow-sm z-20 -translate-x-1/2">
                        </div>

                        <h1 class="text-[clamp(4.5rem,8vw,8.5rem)] font-black leading-[0.9] gradient-text-aurora select-none"
                            style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;
                                   animation: slideUp 1s 1.7s cubic-bezier(0.16,1,0.3,1) both;">
                            {{ strtoupper($hero?->title ?? 'Sofyan Abdul Fatih') }}
                        </h1>
                    </div>

                    {{-- Info Tag --}}
                    <div
                        class="absolute -top-8 left-0 bg-[#1e1e1e] text-[9px] text-white/80 px-2 py-1 rounded-sm border border-white/10 font-mono shadow-xl whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                        W: <span class="text-cyan-400">100%</span> H: <span class="text-cyan-400">Auto</span>
                    </div>
                </div>

                {{-- Photoshop Toolbar --}}
                <div class="flex items-center gap-1 p-1 bg-[#1e1e1e] rounded border border-white/10 shadow-2xl"
                    style="animation: fadeIn 0.6s 2s ease-out both;">

                    {{-- Move Tool --}}
                    <div
                        class="group/tool relative w-8 h-8 flex items-center justify-center rounded hover:bg-[#323232] text-white/50 hover:text-white transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M10 9h4V6h3l-5-5-5 5h3v3zm-1 1H6V7l-5 5 5 5v-3h3v-4zm14 2l-5-5v3h-3v4h3v3l5-5zm-9 3h-4v3H7l5 5 5-5h-3v-3z">
                            </path>
                        </svg>
                        <div
                            class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-black text-[9px] text-white rounded opacity-0 group-hover/tool:opacity-100 whitespace-nowrap pointer-events-none transition-opacity">
                            Move (V)</div>
                    </div>

                    {{-- Marquee Tool --}}
                    <div
                        class="group/tool relative w-8 h-8 flex items-center justify-center rounded bg-[#323232] text-cyan-400 cursor-pointer shadow-inner">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5"
                            stroke-dasharray="3 3" viewBox="0 0 24 24">
                            <rect x="4" y="4" width="16" height="16" rx="1"></rect>
                        </svg>
                        <div
                            class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-black text-[9px] text-white rounded opacity-0 group-hover/tool:opacity-100 whitespace-nowrap pointer-events-none transition-opacity">
                            Rectangular Marquee (M)</div>
                    </div>

                    {{-- Crop Tool --}}
                    <div
                        class="group/tool relative w-8 h-8 flex items-center justify-center rounded hover:bg-[#323232] text-white/50 hover:text-white transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17 15h2V7c0-1.1-.9-2-2-2H9v2h8v8zM7 17V1H5v4H1v2h4v10c0 1.1.9 2 2 2h10v4h2v-4h4v-2H7z">
                            </path>
                        </svg>
                        <div
                            class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-black text-[9px] text-white rounded opacity-0 group-hover/tool:opacity-100 whitespace-nowrap pointer-events-none transition-opacity">
                            Crop (C)</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center gap-8 max-w-2xl"
                style="animation: fadeIn 0.8s 2.1s ease-out both; opacity:0;">
                <p class="text-base md:text-lg text-white/40 leading-relaxed font-light text-center">
                    {{ $hero?->subtitle ?? 'Visual storytelling through motion graphics and cinematic editing.' }}
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 w-full">
                    <a href="{{ $hero?->cta_link ?? '#' }}" data-magnetic
                        class="btn-primary w-full sm:w-auto min-w-[200px]">
                        {{ $hero?->cta_text ?? 'Start a Project' }}
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ $about?->cv_file ? asset('storage/' . $about->cv_file) : '#' }}" download
                        class="btn-secondary w-full sm:w-auto min-w-[200px]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Download CV
                    </a>
                </div>
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         MARQUEE STRIP
    ══════════════════════════════════════ --}}
    <div class="border-y border-white/[0.05] overflow-hidden py-4" style="background: rgba(103,232,249,0.03);">
        <div class="flex gap-0 whitespace-nowrap" style="animation: marqueeScroll 24s linear infinite;">
            @foreach (range(1, 8) as $i)
                <span
                    class="inline-flex items-center gap-6 px-6 text-[11px] font-black tracking-[0.35em] uppercase text-white/60">
                    Graphic Design <span class="gradient-text-aurora">✦</span>
                    Motion Graphics <span class="gradient-text-aurora">✦</span>
                    Video Editing <span class="gradient-text-aurora">✦</span>
                    Visual Identity <span class="gradient-text-aurora">✦</span>
                    Cinematography
                </span>
            @endforeach
        </div>
    </div>


    {{-- ══════════════════════════════════════
         FEATURED WORKS
    ══════════════════════════════════════ --}}
    @if ($projects->count() > 0)
        <section id="works" class="py-28 md:py-40 bg-[#050507] relative overflow-hidden">

            {{-- Aurora bg --}}
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="aurora-blob w-[500px] h-[500px] opacity-[0.06]"
                    style="background: radial-gradient(circle, #818cf8, transparent 70%); top: 20%; right: 0; animation: auroraFloat 14s ease-in-out infinite;">
                </div>
            </div>

            <div class="max-w-[1200px] mx-auto px-6 md:px-12">
                <div class="flex flex-col items-center justify-center mb-16 md:mb-20 aw-reveal text-center relative">
                    {{-- Photoshop Guide Lines --}}
                    <div class="absolute inset-0 pointer-events-none">
                        <div
                            class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-full bg-cyan-400/20 dashed-line-vertical">
                        </div>
                        <div
                            class="absolute top-1/2 left-0 w-full h-px -translate-y-1/2 bg-cyan-400/20 dashed-line-horizontal">
                        </div>
                    </div>

                    <div class="section-label mb-6 relative z-10 bg-[#050507] px-4">Selected Works</div>
                    <div class="relative z-10">
                        <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black leading-[0.9] text-white"
                            style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                            VISUAL<br>
                            <span class="gradient-text-aurora">MASTERPIECES.</span>
                        </h2>

                        {{-- Photoshop Layer Info --}}
                        <div
                            class="absolute -right-24 -top-20 hidden lg:flex flex-col gap-2 p-3 bg-[#1e1e1e] rounded border border-white/10 shadow-xl w-48 text-left transform">
                            <div
                                class="flex items-center justify-between text-[9px] text-white/40 border-b border-white/10 pb-2 mb-1">
                                <span>LAYERS</span>
                                <span class="opacity-50">Normal</span>
                            </div>
                            <div class="flex items-center gap-2 text-[10px] text-white/80 bg-[#323232] p-1.5 rounded">
                                <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>Masterpieces_Text</span>
                            </div>
                            <div class="flex items-center gap-2 text-[10px] text-white/50 p-1.5">
                                <svg class="w-3 h-3 opacity-30" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Background_Glow</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper worksSwiper overflow-visible aw-reveal relative">
                    <div class="swiper-wrapper items-stretch">
                        @foreach ($projects as $project)
                            <div class="swiper-slide !h-auto !w-full md:!w-[80%] lg:!w-[70%]">
                                <a href="{{ route('works.show', $project->slug) }}"
                                    class="group flex flex-col h-full transform transition-all duration-500 hover:scale-[1.02]">
                                    <div class="relative overflow-hidden aspect-video mb-5 bg-[#0d0d12] rounded-2xl border border-white/[0.06] shadow-2xl"
                                        onmouseenter="const v = this.querySelector('video'); if(v) { v.play(); this.timer = setTimeout(() => v.pause(), 8000); }"
                                        onmouseleave="const v = this.querySelector('video'); if(v) { clearTimeout(this.timer); v.pause(); v.currentTime = 0; }">
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
                                                <div
                                                    class="absolute top-3 right-3 z-20 w-6 h-6 flex items-center justify-center bg-black/50 backdrop-blur-sm rounded-full border border-white/10">
                                                    <svg class="w-3 h-3 text-white/80" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z" />
                                                    </svg>
                                                </div>
                                                <video src="{{ $fileUrl }}" muted loop playsinline
                                                    class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105"></video>
                                            @else
                                                <img src="{{ $fileUrl }}"
                                                    class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105">
                                            @endif
                                        @endif
                                        <div
                                            class="absolute inset-0 bg-[#050507]/0 group-hover:bg-[#050507]/20 transition-colors duration-500">
                                        </div>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div
                                                class="w-12 h-12 rounded-full border border-white/60 flex items-center justify-center opacity-0 group-hover:opacity-100 scale-75 group-hover:scale-100 transition-all duration-400 bg-white/10 backdrop-blur-sm">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                            class="absolute top-4 left-4 text-[9px] font-bold tracking-[0.3em] text-white/30">
                                            {{ str_pad($loop->index + 1, 2, '0', STR_PAD_LEFT) }}
                                        </div>
                                    </div>
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <h3
                                                class="text-base md:text-lg font-bold tracking-[-0.02em] text-white/80 group-hover:text-white transition-colors duration-200 mb-1">
                                                {{ $project->title }}</h3>
                                            <p class="text-xs text-white/25 line-clamp-1 font-light tracking-wide">
                                                {{ $project->description }}</p>
                                        </div>
                                        <div
                                            class="w-7 h-7 border border-white/10 rounded-full flex items-center justify-center flex-shrink-0 group-hover:border-cyan-400/50 group-hover:bg-cyan-400/10 transition-all duration-300 mt-0.5">
                                            <svg class="w-3 h-3 text-white/30 group-hover:text-cyan-400 transition-colors"
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

                <div class="flex items-center gap-4 mt-10 aw-reveal">
                    <button
                        class="works-prev group w-10 h-10 border border-white/10 rounded-full flex items-center justify-center hover:border-cyan-400/40 hover:bg-cyan-400/10 active:scale-90 transition-all duration-200">
                        <svg class="w-4 h-4 text-white/40 group-hover:text-cyan-400 transition-colors" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <div class="swiper-pagination-works flex items-center gap-2"></div>
                    <button
                        class="works-next group w-10 h-10 border border-white/10 rounded-full flex items-center justify-center hover:border-cyan-400/40 hover:bg-cyan-400/10 active:scale-90 transition-all duration-200">
                        <svg class="w-4 h-4 text-white/40 group-hover:text-cyan-400 transition-colors" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                    <a href="{{ route('works') }}" wire:navigate
                        class="md:hidden ml-auto btn-ghost text-[9px] py-2 px-3">All →</a>
                </div>
            </div>
        </section>
    @endif


    {{-- ══════════════════════════════════════
         SERVICES — BENTO GRID
    ══════════════════════════════════════ --}}
    @if ($services->count() > 0)
        <section id="services" class="py-28 md:py-40 relative overflow-hidden" style="background: #070710;">

            {{-- Aurora bg --}}
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="aurora-blob w-[600px] h-[600px] opacity-[0.08]"
                    style="background: radial-gradient(circle, #67e8f9, transparent 70%); top: -100px; right: -100px; animation: auroraFloat2 16s ease-in-out infinite;">
                </div>
                <div class="aurora-blob w-[400px] h-[400px] opacity-[0.06]"
                    style="background: radial-gradient(circle, #34d399, transparent 70%); bottom: 0; left: 10%; animation: auroraFloat 20s ease-in-out infinite;">
                </div>
            </div>

            <div class="max-w-[1200px] mx-auto px-6 md:px-12">

                {{-- Centered header --}}
                <div class="text-center mb-16 md:mb-20 aw-reveal">
                    <div class="flex items-center justify-center mb-6">
                        <div class="section-label">What I Offer</div>
                    </div>
                    <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black leading-[0.9] text-white mb-5"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                        CREATIVE<br>
                        <span class="gradient-text-aurora">SERVICES.</span>
                    </h2>
                    <p class="text-base text-white/30 max-w-md mx-auto leading-relaxed font-light">
                        Digital solutions that simplify, streamline, and strengthen brands with precision and purpose.
                    </p>
                </div>

                {{-- BENTO GRID --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 auto-rows-auto" id="services-bento">
                    @foreach ($services as $index => $service)
                        @php
                            $spans = [
                                0 => 'lg:col-span-2',
                                1 => 'lg:col-span-1',
                                2 => 'lg:col-span-1',
                                3 => 'lg:col-span-2',
                            ];
                            $spanClass = $spans[$index % 4] ?? 'lg:col-span-1';
                            $isFeatured = $index % 4 === 0 || $index % 4 === 3;
                        @endphp
                        <div class="bento-card aw-reveal {{ $spanClass }} {{ $isFeatured ? 'min-h-[220px]' : 'min-h-[180px]' }} relative overflow-hidden"
                            style="--delay:{{ $index * 80 }}ms;">
                            <a href="{{ route('services.show', $service->slug) }}"
                                class="group flex flex-col h-full p-8 relative z-10">

                                {{-- BG Icon & Gradient --}}
                                @if ($service->icon)
                                    <div class="absolute inset-0 z-0">
                                        {{-- Icon as Background --}}
                                        <img src="{{ asset('storage/' . $service->icon) }}"
                                            class="absolute right-[-10%] bottom-[-10%] w-[60%] h-[60%] object-contain opacity-[0.8] group-hover:opacity-[0.1] group-hover:scale-110 transition-all duration-700 rotate-[-15deg]">

                                        {{-- Gradient Overlay (Top-Right Black to Transparent) --}}
                                        <div
                                            class="absolute inset-0 bg-gradient-to-bl from-black/80 via-black/20 to-transparent">
                                        </div>
                                    </div>
                                @endif

                                {{-- Number --}}
                                <div class="flex items-start justify-between mb-auto relative z-10">
                                    <span
                                        class="text-[9px] font-bold tracking-[0.4em] text-white/15">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div
                                        class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center group-hover:border-cyan-400/40 group-hover:bg-cyan-400/10 transition-all duration-300">
                                        <svg class="w-3.5 h-3.5 text-white/20 group-hover:text-cyan-400 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all duration-300"
                                            fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </div>
                                </div>

                                {{-- Icon --}}
                                @if ($service->icon)
                                    <div class="w-11 h-11 rounded-xl border border-white/10 flex items-center justify-center mb-4 mt-8 group-hover:border-cyan-400/30 transition-all duration-300 relative z-10"
                                        style="background: rgba(103,232,249,0.06);">
                                        <img src="{{ asset('storage/' . $service->icon) }}"
                                            class="w-5 h-5 object-contain opacity-50 group-hover:opacity-80 transition-opacity">
                                    </div>
                                @else
                                    <div class="w-11 h-11 rounded-xl border border-white/10 flex items-center justify-center mb-4 mt-8 relative z-10"
                                        style="background: rgba(103,232,249,0.06);">
                                        <span class="text-cyan-400/50 text-lg">✦</span>
                                    </div>
                                @endif

                                <h3 class="text-xl font-black tracking-[-0.02em] text-white/70 group-hover:text-white transition-colors duration-300 mb-2 relative z-10"
                                    style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                                    {{ strtoupper($service->title) }}
                                </h3>
                                <p
                                    class="text-xs text-white/25 leading-relaxed font-light line-clamp-2 group-hover:text-white/40 transition-colors duration-300 relative z-10">
                                    {{ $service->description }}
                                </p>

                                {{-- Bottom accent line on hover --}}
                                <div class="absolute bottom-0 left-0 right-0 h-px rounded-b-[20px] z-20"
                                    style="background: linear-gradient(90deg, transparent, rgba(103,232,249,0.3), transparent); opacity: 0; transition: opacity 0.4s;"
                                    onmouseenter="this.style.opacity='1'" onmouseleave="this.style.opacity='0'"></div>
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
        <section id="features" class="py-28 md:py-40 bg-[#050507] relative overflow-hidden">

            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="aurora-blob w-[500px] h-[500px] opacity-[0.07]"
                    style="background: radial-gradient(circle, #a78bfa, transparent 70%); top: 10%; left: -100px; animation: auroraFloat2 18s ease-in-out infinite;">
                </div>
            </div>

            <div class="max-w-[1200px] mx-auto px-6 md:px-12">
                <div class="text-center max-w-2xl mx-auto mb-20 aw-reveal">
                    <div class="flex items-center justify-center mb-6">
                        <div class="section-label">Why Work With Me</div>
                    </div>
                    <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black leading-[0.9] text-white"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                        ARTISTIC<br>
                        <span class="gradient-text-aurora">VISION.</span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="features-grid">
                    @foreach ($features as $index => $feature)
                        @php $isAccent = ($index + 1) % 2 === 0; @endphp
                        <div class="feature-card group relative p-8 md:p-10 overflow-hidden cursor-default opacity-0 translate-y-8 rounded-[20px]
                            {{ $isAccent
                                ? 'border border-indigo-500/20 hover:border-indigo-400/40'
                                : 'border border-white/[0.06] hover:border-white/15' }}
                            hover:-translate-y-1"
                            style="
                            {{ $isAccent ? 'background: linear-gradient(135deg, rgba(99,102,241,0.12) 0%, rgba(139,92,246,0.08) 100%);' : 'background: rgba(255,255,255,0.02);' }}
                            transition-delay: {{ $index * 70 }}ms;">

                            <div class="absolute top-4 right-5 text-[2.5rem] font-black leading-none select-none text-white/[0.04]"
                                style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>

                            <div class="w-11 h-11 rounded-xl border flex items-center justify-center mb-8 transition-all duration-400
                                {{ $isAccent ? 'border-indigo-400/20 group-hover:border-indigo-400/50' : 'border-white/[0.07] group-hover:border-cyan-400/30' }}"
                                style="{{ $isAccent ? 'background: rgba(99,102,241,0.1);' : 'background: rgba(103,232,249,0.04);' }}">
                                @if ($feature->icon)
                                    <img src="{{ asset('storage/' . $feature->icon) }}"
                                        class="w-5 h-5 object-contain opacity-40 group-hover:opacity-70 transition-all duration-300">
                                @else
                                    <span
                                        class="text-sm {{ $isAccent ? 'text-indigo-400/50' : 'text-cyan-400/50' }}">✦</span>
                                @endif
                            </div>

                            <h3
                                class="text-lg font-bold tracking-[-0.02em] mb-3 transition-colors duration-200
                                {{ $isAccent ? 'text-white/90' : 'text-white/60 group-hover:text-white' }}">
                                {{ $feature->title }}
                            </h3>
                            <p
                                class="text-sm leading-relaxed font-light {{ $isAccent ? 'text-indigo-100/50' : 'text-white/25' }}">
                                {{ $feature->description }}
                            </p>

                            <div class="absolute bottom-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700 rounded-b-[20px]"
                                style="{{ $isAccent ? 'background: linear-gradient(90deg, #818cf8, transparent);' : 'background: linear-gradient(90deg, #67e8f9, transparent);' }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- ══════════════════════════════════════
         ABOUT — Split cinematic layout
    ══════════════════════════════════════ --}}
    <section id="about" class="py-28 md:py-40 overflow-hidden relative" style="background: #060610;">

        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="aurora-blob w-[700px] h-[700px] opacity-[0.07]"
                style="background: radial-gradient(circle, #67e8f9, transparent 70%); bottom: -200px; right: -100px; animation: auroraFloat 15s ease-in-out infinite;">
            </div>
        </div>

        <div class="max-w-[1200px] mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center relative z-10">

                {{-- Image --}}
                <div class="aw-reveal order-2 lg:order-1">
                    <div class="group relative">
                        {{-- Glow border --}}
                        <div class="absolute -inset-px rounded-[24px] opacity-0 group-hover:opacity-100 transition-opacity duration-700"
                            style="background: linear-gradient(135deg, rgba(103,232,249,0.2), rgba(167,139,250,0.15)); border-radius: 24px;">
                        </div>

                        <div
                            class="relative aspect-[3/4] overflow-hidden bg-[#0d0d1a] rounded-[22px] border border-white/[0.06]">
                            @if ($about?->image)
                                <img src="{{ asset('storage/' . $about->image) }}"
                                    class="w-full h-full object-cover object-top transition-all duration-1000 group-hover:scale-[1.04]">
                            @else
                                <div class="w-full h-full bg-[#0d0d1a]"></div>
                            @endif
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#060610]/60 via-transparent to-transparent">
                            </div>
                        </div>

                        {{-- Floating stat --}}
                        <div class="absolute -bottom-5 -right-5 px-6 py-4 rounded-2xl shadow-2xl border border-white/10"
                            style="background: linear-gradient(135deg, rgba(103,232,249,0.15), rgba(129,140,248,0.1)); backdrop-filter: blur(16px);">
                            <p class="text-3xl font-black text-white"
                                style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">40+</p>
                            <p class="text-[9px] font-bold uppercase tracking-[0.2em] text-white/40">Projects</p>
                        </div>
                    </div>

                    <div class="mt-12 grid grid-cols-2 gap-3">
                        @foreach ([['Based in', 'Indonesia'], ['Status', 'Open to work']] as $f)
                            <div class="bento-card p-4 hover:transform-none">
                                <p class="text-[8px] font-bold uppercase tracking-[0.3em] text-white/20 mb-1">
                                    {{ $f[0] }}</p>
                                <p
                                    class="text-sm font-medium {{ $loop->last ? 'text-emerald-400' : 'text-white/60' }}">
                                    {{ $f[1] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Content --}}
                <div class="order-1 lg:order-2 aw-reveal" style="--delay:150ms">
                    <div class="section-label mb-6">About Me</div>

                    <h2 class="text-[clamp(2.5rem,5vw,4rem)] font-black leading-[0.9] text-white mb-8"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                        DESIGNING<br>
                        <span class="gradient-text-aurora">PRECISION.</span>
                    </h2>

                    <p class="text-lg md:text-xl text-white/60 leading-relaxed font-light mb-5">
                        {{ Str::before($about?->description ?? '', '.') }}.
                    </p>
                    <p class="text-base text-white/25 leading-relaxed font-light mb-12">
                        {{ Str::after($about?->description ?? '', '.') }}
                    </p>

                    <div class="grid grid-cols-2 gap-3 mb-10">
                        @foreach ([['Philosophy', 'Form follows function, but emotion leads the way.'], ['Location', 'Working globally, based in Indonesia.']] as $v)
                            <div class="bento-card p-5 hover:transform-none">
                                <p class="text-[8px] font-bold uppercase tracking-[0.3em] text-white/20 mb-2">
                                    {{ $v[0] }}</p>
                                <p class="text-xs text-white/40 leading-relaxed">{{ $v[1] }}</p>
                            </div>
                        @endforeach
                    </div>

                    @if (isset($about->button_text) && $about->button_text)
                        <a href="{{ $about?->button_link ?? '#' }}" class="btn-primary">
                            {{ $about?->button_text }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         PRICING — Apple-style cards
    ══════════════════════════════════════ --}}
    <section id="pricing" class="py-28 md:py-40 bg-[#050507] relative overflow-hidden">

        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="aurora-blob w-[600px] h-[600px] opacity-[0.08]"
                style="background: radial-gradient(circle, #a78bfa, transparent 70%); top: 50%; left: 50%; transform: translate(-50%,-50%); animation: pulse-slow 6s ease-in-out infinite;">
            </div>
        </div>

        <div class="max-w-[1200px] mx-auto px-6 md:px-12">
            <div class="text-center max-w-xl mx-auto mb-20 aw-reveal">
                <div class="flex items-center justify-center mb-6">
                    <div class="section-label">Investment</div>
                </div>
                <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black leading-[0.9] text-white"
                    style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                    READY TO<br>
                    <span class="gradient-text-aurora">LEVEL UP?</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @foreach ($pricing_plans as $index => $plan)
                    @php $isMain = $index === 1; @endphp
                    <div class="aw-reveal" style="--delay:{{ $index * 100 }}ms">
                        <div class="group relative flex flex-col h-full rounded-[22px] overflow-hidden border transition-all duration-400 hover:-translate-y-2
                                {{ $isMain
                                    ? 'border-transparent shadow-[0_20px_80px_rgba(103,232,249,0.15)]'
                                    : 'border-white/[0.06] hover:border-white/15 bg-[#0a0a12]' }}"
                            style="{{ $isMain ? 'background: linear-gradient(135deg, #0a1628, #120a28); border: 1px solid rgba(103,232,249,0.25);' : '' }}">

                            @if ($isMain)
                                <div class="px-8 pt-5 pb-0">
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[9px] font-bold uppercase tracking-[0.25em]"
                                        style="background: rgba(103,232,249,0.12); color: #67e8f9; border: 1px solid rgba(103,232,249,0.2);">
                                        Most Popular
                                    </span>
                                </div>
                            @endif

                            <div class="flex-1 flex flex-col p-8 {{ $isMain ? 'pt-4' : '' }}">
                                <div
                                    class="mb-8 pb-8 border-b {{ $isMain ? 'border-white/10' : 'border-white/[0.05]' }}">
                                    <h3 class="text-2xl font-black tracking-[-0.03em] mb-1 text-white/80"
                                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                                        {{ strtoupper($plan->name) }}
                                    </h3>
                                    <p class="text-3xl font-black mb-3 gradient-text-aurora"
                                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                                        {{ $plan->price }}
                                    </p>
                                    <p class="text-sm leading-relaxed font-light text-white/30">
                                        {{ $plan->description }}</p>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ $plan->cta_link ?? '#' }}"
                                        class="{{ $isMain ? 'btn-primary' : 'btn-secondary' }} w-full justify-center">
                                        {{ $plan->cta_text ?? 'Get Started' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="aw-reveal flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 p-7 rounded-[18px] border border-white/[0.06]"
                style="background: rgba(255,255,255,0.02);">
                <div>
                    <p class="text-base font-bold tracking-[-0.01em] text-white/60 mb-0.5">Need a custom solution?</p>
                    <p class="text-xs text-white/20 font-light">If your project doesn't fit, let's build something
                        tailored.</p>
                </div>
                <a href="#contact" class="btn-ghost flex-shrink-0">
                    Contact for Custom Work
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
    <section id="testimonials" class="py-28 md:py-40 relative overflow-hidden" style="background: #060610;">

        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="aurora-blob w-[500px] h-[500px] opacity-[0.07]"
                style="background: radial-gradient(circle, #34d399, transparent 70%); top: 0; right: 10%; animation: auroraFloat 20s ease-in-out infinite;">
            </div>
        </div>

        <div class="max-w-[1200px] mx-auto px-6 md:px-12">
            <div class="flex items-end justify-between mb-16 md:mb-20 aw-reveal">
                <div>
                    <div class="section-label mb-6">Social Proof</div>
                    <h2 class="text-[clamp(2.5rem,6vw,5rem)] font-black leading-[0.9] text-white"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                        CLIENT<br>
                        <span class="gradient-text-aurora">FEEDBACK.</span>
                    </h2>
                </div>
            </div>

            <div class="swiper testimonialSwiper overflow-visible aw-reveal">
                <div class="swiper-wrapper items-stretch">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide !h-auto py-2">
                            <div class="group h-full flex flex-col p-8 rounded-[20px] border border-white/[0.06] hover:border-white/15 hover:-translate-y-1 transition-all duration-400 relative overflow-hidden"
                                style="background: rgba(255,255,255,0.02);">
                                <div class="absolute top-4 right-6 text-7xl font-black text-white/[0.03] leading-none select-none"
                                    style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">"</div>

                                <div class="flex gap-1 mb-6">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-3.5 h-3.5 text-white/20 group-hover:text-cyan-400/60 transition-colors"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>

                                <p
                                    class="text-sm md:text-base text-white/40 leading-relaxed font-light italic mb-8 flex-1 relative z-10 group-hover:text-white/60 transition-colors duration-300">
                                    "{{ $testimonial->content }}"
                                </p>

                                <div class="flex items-center gap-4 pt-5 border-t border-white/[0.05]">
                                    <div
                                        class="w-10 h-10 overflow-hidden bg-[#0d0d1a] border border-white/10 rounded-full flex-shrink-0">
                                        @if ($testimonial->avatar)
                                            <img src="{{ asset('storage/' . $testimonial->avatar) }}"
                                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-white/20 text-sm font-bold">
                                                {{ substr($testimonial->name, 0, 1) }}</div>
                                        @endif
                                    </div>
                                    <div>
                                        <p
                                            class="text-sm font-bold tracking-[-0.01em] text-white/60 group-hover:text-white transition-colors">
                                            {{ $testimonial->name }}</p>
                                        <p class="text-[9px] font-bold uppercase tracking-[0.2em] text-white/20">
                                            {{ $testimonial->position ?? 'Client' }}</p>
                                    </div>
                                </div>

                                <div class="absolute bottom-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700 rounded-b-[20px]"
                                    style="background: linear-gradient(90deg, #67e8f9, #a78bfa, transparent);"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-4 mt-10 aw-reveal">
                <button
                    class="testi-prev group w-10 h-10 border border-white/10 rounded-full flex items-center justify-center hover:border-cyan-400/40 hover:bg-cyan-400/10 active:scale-90 transition-all duration-200">
                    <svg class="w-4 h-4 text-white/30 group-hover:text-cyan-400 transition-colors" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <div class="swiper-pagination-testimonials flex items-center gap-2"></div>
                <button
                    class="testi-next group w-10 h-10 border border-white/10 rounded-full flex items-center justify-center hover:border-cyan-400/40 hover:bg-cyan-400/10 active:scale-90 transition-all duration-200">
                    <svg class="w-4 h-4 text-white/30 group-hover:text-cyan-400 transition-colors" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>

            <div class="mt-20 pt-16 border-t border-white/[0.05]">
                <livewire:public.components.testimonial-form />
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         CONTACT — Aurora gradient bg
    ══════════════════════════════════════ --}}
    <section id="contact" class="relative pt-36 md:pt-48 pb-28 md:pb-40 overflow-hidden"
        style="background: linear-gradient(135deg, #030b1a 0%, #0a0518 40%, #050507 100%);">

        {{-- Aurora overlays --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="aurora-blob w-[800px] h-[800px] opacity-[0.12]"
                style="background: radial-gradient(circle, #67e8f9, transparent 60%); top: -200px; left: -200px; animation: auroraFloat 15s ease-in-out infinite;">
            </div>
            <div class="aurora-blob w-[600px] h-[600px] opacity-[0.10]"
                style="background: radial-gradient(circle, #818cf8, transparent 60%); top: 30%; right: -100px; animation: auroraFloat2 18s ease-in-out infinite;">
            </div>
            <div class="aurora-blob w-[400px] h-[400px] opacity-[0.08]"
                style="background: radial-gradient(circle, #34d399, transparent 60%); bottom: 10%; left: 40%; animation: auroraFloat 22s ease-in-out infinite;">
            </div>
        </div>

        {{-- Top divider --}}
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-none">
            <svg viewBox="0 0 1440 160" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
                class="w-full h-24 md:h-40">
                <path
                    d="M0,0 L1440,0 L1440,60 C1320,130 1200,160 1080,140 C960,120 840,60 720,80 C600,100 480,150 360,130 C240,110 120,50 0,90 Z"
                    fill="#050507" />
            </svg>
        </div>

        <div class="max-w-[1200px] mx-auto px-6 md:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-start">

                {{-- Left --}}
                <div class="aw-reveal">
                    <div class="section-label mb-6"
                        style="background: rgba(103,232,249,0.1); border-color: rgba(103,232,249,0.2);">Get In Touch
                    </div>
                    <h2 class="text-[clamp(3rem,7vw,6rem)] font-black leading-[0.88] text-white mb-8"
                        style="font-family: 'Bebas Neue', 'Arial Black', sans-serif;">
                        LET'S<br>
                        <span class="gradient-text-aurora">CONNECT.</span>
                    </h2>
                    <p class="text-base text-white/70 leading-relaxed font-light max-w-xs mb-12">
                        Ready to start your next project? I am currently available for new opportunities.
                    </p>

                    <div class="inline-flex items-center gap-3 px-5 py-3.5 rounded-full border"
                        style="background: rgba(52,211,153,0.08); border-color: rgba(52,211,153,0.2);">
                        <div class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-emerald-400">Available for
                            new projects</span>
                    </div>
                </div>

                {{-- Form --}}
                <div class="aw-reveal" style="--delay:150ms">
                    @if (session()->has('message'))
                        <div class="mb-5 px-5 py-4 rounded-xl border text-sm text-white"
                            style="background: rgba(103,232,249,0.08); border-color: rgba(103,232,249,0.2);">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="sendMessage" class="space-y-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <input type="text" wire:model="name" placeholder="Your name" required
                                class="w-full px-5 py-4 rounded-xl text-white placeholder-white/25 text-sm font-light tracking-[-0.01em] focus:outline-none transition-all duration-300 border"
                                style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08); focus:border-color: rgba(103,232,249,0.4);">
                            <input type="email" wire:model="email" placeholder="Email address" required
                                class="w-full px-5 py-4 rounded-xl text-white placeholder-white/25 text-sm font-light tracking-[-0.01em] focus:outline-none transition-all duration-300 border"
                                style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08);">
                        </div>
                        <input type="text" wire:model="subject" placeholder="Subject"
                            class="w-full px-5 py-4 rounded-xl text-white placeholder-white/25 text-sm font-light tracking-[-0.01em] focus:outline-none transition-all duration-300 border"
                            style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08);">
                        <textarea wire:model="message" rows="5" placeholder="Tell me about your project..." required
                            class="w-full px-5 py-4 rounded-xl text-white placeholder-white/25 text-sm font-light tracking-[-0.01em] resize-none focus:outline-none transition-all duration-300 border"
                            style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08);"></textarea>
                        <button type="submit" class="btn-primary w-full text-[11px]">
                            Send Message
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         SCRIPTS
    ══════════════════════════════════════ --}}
    <script>
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

        function initPage() {
            initSwipers();
            initReveal();
        }
        document.addEventListener('DOMContentLoaded', initPage);
        document.addEventListener('livewire:navigated', initPage);

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
                            slidesPerView: 2.2,
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
