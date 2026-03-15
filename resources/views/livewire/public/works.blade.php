<div class="min-h-screen bg-[#050507] text-white antialiased overflow-x-hidden" style="font-family: -apple-system, 'SF Pro Display', 'Helvetica Neue', sans-serif;">

    @section('meta_title', 'Selected Works | Sofyan Abdul Fatih')
    @section('meta_description', 'A collection of digital experiences built with precision, focusing on aesthetic impact and technical performance.')
    @section('meta_keywords', 'Works, Projects, Portfolio, Case Studies, Sofyan Abdul Fatih')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes auroraFloat {
            0%, 100% { transform: translate(0,0) scale(1); }
            33% { transform: translate(30px,-20px) scale(1.04); }
            66% { transform: translate(-20px,10px) scale(0.97); }
        }
        @keyframes auroraFloat2 {
            0%, 100% { transform: translate(0,0) scale(1); }
            33% { transform: translate(-30px,20px) scale(1.06); }
            66% { transform: translate(20px,-15px) scale(0.96); }
        }

        .aurora-blob {
            position: absolute; border-radius: 50%;
            filter: blur(100px); pointer-events: none;
        }

        .reveal {
            opacity: 0; transform: translateY(20px);
            transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1);
            transition-delay: var(--delay, 0ms);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        .gradient-text {
            background: linear-gradient(135deg, #67e8f9 0%, #818cf8 45%, #a78bfa 75%, #34d399 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        .pill-label {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 5px 14px;
            background: rgba(103,232,249,0.07);
            border: 1px solid rgba(103,232,249,0.14);
            border-radius: 100px;
            font-size: 9px; font-weight: 700; letter-spacing: 0.4em; text-transform: uppercase;
            color: rgba(103,232,249,0.8);
        }

        .divider {
            width: 100%; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.06), transparent);
        }

        /* Filter pills */
        .filter-pill {
            padding: 7px 16px;
            border-radius: 100px;
            font-size: 9px; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase;
            border: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.35);
            background: transparent;
            transition: all 0.25s ease;
            cursor: pointer;
        }
        .filter-pill:hover {
            border-color: rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.7);
        }
        .filter-pill.active {
            background: linear-gradient(135deg, rgba(103,232,249,0.15), rgba(129,140,248,0.12));
            border-color: rgba(103,232,249,0.3);
            color: #67e8f9;
        }

        /* Search */
        .search-input {
            width: 100%;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            color: white;
            font-size: 14px; font-weight: 300;
            padding: 14px 48px;
            transition: all 0.3s ease;
            outline: none;
        }
        .search-input::placeholder { color: rgba(255,255,255,0.2); }
        .search-input:focus {
            border-color: rgba(103,232,249,0.25);
            background: rgba(103,232,249,0.03);
            box-shadow: 0 0 0 4px rgba(103,232,249,0.05);
        }

        /* Project card */
        .project-card { transition: transform 0.5s cubic-bezier(0.16,1,0.3,1); }
        .project-card:hover { transform: translateY(-4px); }

        .project-thumb {
            position: relative; overflow: hidden;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.06);
            aspect-ratio: 5/3;
            background: #0d0d12;
            transition: border-color 0.4s ease;
        }
        .project-card:hover .project-thumb {
            border-color: rgba(103,232,249,0.2);
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }

        .project-thumb img,
        .project-thumb video {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 1.5s ease-out;
        }
        .project-card:hover .project-thumb img,
        .project-card:hover .project-thumb video { transform: scale(1.05); }

        .thumb-overlay {
            position: absolute; inset: 0; border-radius: 18px;
            background: rgba(5,5,7,0);
            display: flex; align-items: center; justify-content: center;
            transition: background 0.4s ease;
        }
        .project-card:hover .thumb-overlay { background: rgba(5,5,7,0.5); }

        .view-btn {
            opacity: 0; transform: scale(0.85);
            transition: all 0.35s cubic-bezier(0.16,1,0.3,1);
            padding: 10px 22px; border-radius: 100px;
            background: linear-gradient(135deg, #67e8f9, #818cf8);
            color: #050507; font-size: 10px; font-weight: 700;
            letter-spacing: 0.15em; text-transform: uppercase;
            white-space: nowrap;
        }
        .project-card:hover .view-btn { opacity: 1; transform: scale(1); }

        .thumb-sweep {
            position: absolute; bottom: 0; left: 0; right: 0; height: 2px; border-radius: 0 0 18px 18px;
            background: linear-gradient(90deg, #67e8f9, #818cf8, #a78bfa);
            transform: scaleX(0); transform-origin: left;
            transition: transform 0.6s cubic-bezier(0.16,1,0.3,1);
        }
        .project-card:hover .thumb-sweep { transform: scaleX(1); }

        .arrow-icon {
            width: 28px; height: 28px; border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
            transition: all 0.3s ease;
        }
        .project-card:hover .arrow-icon {
            border-color: rgba(103,232,249,0.4);
            background: rgba(103,232,249,0.08);
        }
        .project-card:hover .arrow-icon svg { color: #67e8f9; }

        /* Pagination */
        .pagination { display: flex; gap: 6px; font-family: monospace; font-size: 10px; }
        .page-item.active .page-link {
            background: linear-gradient(135deg, #67e8f9, #818cf8);
            color: #050507; border-color: transparent;
        }
        .page-link {
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 100px;
            padding: 8px 14px; color: rgba(255,255,255,0.35);
            transition: all 0.2s;
        }
        .page-link:hover { border-color: rgba(103,232,249,0.3); color: #67e8f9; }

        /* Footer CTA */
        .footer-aurora {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, #030b1a 0%, #0a0520 50%, #050507 100%);
        }

        .btn-primary-sm {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 14px 28px; border-radius: 100px;
            background: linear-gradient(135deg, #67e8f9, #818cf8);
            color: #050507; font-weight: 700; font-size: 11px;
            letter-spacing: 0.15em; text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(103,232,249,0.2);
        }
        .btn-primary-sm:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 12px 40px rgba(103,232,249,0.3); }

        .btn-outline-sm {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 26px; border-radius: 100px;
            border: 1px solid rgba(255,255,255,0.12);
            color: rgba(255,255,255,0.5); font-weight: 700; font-size: 11px;
            letter-spacing: 0.15em; text-transform: uppercase;
            transition: all 0.3s ease;
        }
        .btn-outline-sm:hover { border-color: rgba(255,255,255,0.3); color: white; }

        ::-webkit-scrollbar { width: 3px; }
        ::-webkit-scrollbar-track { background: #050507; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 9999px; }
        ::selection { background: #67e8f9; color: #050507; }
    </style>

    {{-- Aurora fixed bg --}}
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="aurora-blob w-[700px] h-[700px] opacity-[0.08]" style="background: radial-gradient(circle, #67e8f9, transparent 70%); top: -150px; right: -150px; animation: auroraFloat 15s ease-in-out infinite;"></div>
        <div class="aurora-blob w-[500px] h-[500px] opacity-[0.06]" style="background: radial-gradient(circle, #818cf8, transparent 70%); top: 40%; left: -100px; animation: auroraFloat2 20s ease-in-out infinite;"></div>
        <div class="aurora-blob w-[400px] h-[400px] opacity-[0.05]" style="background: radial-gradient(circle, #34d399, transparent 70%); bottom: 20%; right: 10%; animation: auroraFloat 25s ease-in-out infinite reverse;"></div>
    </div>


    {{-- ══════════════════════════════════
         HERO HEADER — Centered
    ══════════════════════════════════ --}}
    <header class="relative z-10 pt-40 pb-24 px-6 text-center">
        <div class="max-w-[760px] mx-auto">

            <div class="pill-label mx-auto mb-8 w-fit" style="animation: fadeUp 0.7s 0.1s ease both;">
                Curated Gallery · 2026
            </div>

            <h1 class="text-[clamp(3.5rem,10vw,8rem)] font-black leading-[0.88] text-white mb-6"
                style="font-family:'Bebas Neue','Arial Black',sans-serif; animation: fadeUp 0.8s 0.2s cubic-bezier(0.16,1,0.3,1) both;">
                SELECTED<br><span class="gradient-text">WORKS.</span>
            </h1>

            <p class="text-base md:text-lg text-white/35 leading-relaxed font-light max-w-md mx-auto mb-10"
                style="animation: fadeUp 0.8s 0.3s ease both;">
                Digital experiences built with technical precision and editorial aesthetic impact.
            </p>

            <div style="animation: fadeUp 0.7s 0.4s ease both;">
                <a href="{{ route('archive') }}" wire:navigate class="btn-outline-sm">
                    Archived Projects
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>


    {{-- ══════════════════════════════════
         FILTERS — Centered pill row
    ══════════════════════════════════ --}}
    <section class="relative z-10 px-6 mb-20">
        <div class="max-w-[900px] mx-auto">

            {{-- Search --}}
            <div class="relative mb-6" style="animation: fadeUp 0.7s 0.5s ease both;">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/20 pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search projects…"
                    class="search-input">
                <button wire:click="$set('search', '')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-white/20 hover:text-white/60 transition-colors"
                    x-show="$wire.search !== ''" x-cloak>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Category pills --}}
            <div class="flex flex-wrap items-center justify-center gap-2 mb-4" style="animation: fadeUp 0.7s 0.55s ease both;">
                <span class="text-[8px] font-bold uppercase tracking-[0.35em] text-white/15 mr-1">Category</span>
                <button wire:click="$set('category', '')"
                    class="filter-pill {{ !$category ? 'active' : '' }}">All</button>
                @foreach ($categories as $cat)
                <button wire:click="$set('category', '{{ $cat }}')"
                    class="filter-pill {{ $category === $cat ? 'active' : '' }}">{{ $cat }}</button>
                @endforeach
            </div>

            {{-- Year pills --}}
            <div class="flex flex-wrap items-center justify-center gap-2" style="animation: fadeUp 0.7s 0.6s ease both;">
                <span class="text-[8px] font-bold uppercase tracking-[0.35em] text-white/15 mr-1">Year</span>
                <button wire:click="$set('year', '')"
                    class="filter-pill {{ !$year ? 'active' : '' }}">All</button>
                @foreach ($years as $y)
                <button wire:click="$set('year', '{{ $y }}')"
                    class="filter-pill font-mono {{ $year == $y ? 'active' : '' }}">{{ $y }}</button>
                @endforeach
            </div>

            {{-- Active tags --}}
            @if ($search || $category || $year)
            <div class="mt-5 flex items-center justify-center gap-2 flex-wrap">
                <span class="text-[8px] uppercase tracking-[0.3em] text-white/20">Filtering by</span>
                @if ($search)
                <button wire:click="$set('search', '')"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[9px] font-bold text-white/40 hover:text-white transition-colors"
                    style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);">
                    "{{ $search }}" <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                @endif
                @if ($category)
                <button wire:click="$set('category', '')"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[9px] font-bold text-cyan-400 hover:opacity-80 transition-opacity"
                    style="background: rgba(103,232,249,0.08); border: 1px solid rgba(103,232,249,0.2);">
                    {{ $category }} <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                @endif
                @if ($year)
                <button wire:click="$set('year', '')"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[9px] font-bold font-mono text-cyan-400 hover:opacity-80 transition-opacity"
                    style="background: rgba(103,232,249,0.08); border: 1px solid rgba(103,232,249,0.2);">
                    {{ $year }} <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                @endif
                <button wire:click="$set('search', ''); $set('category', ''); $set('year', '')"
                    class="text-[9px] uppercase tracking-[0.25em] text-white/20 hover:text-cyan-400 transition-colors ml-1">
                    Clear all
                </button>
            </div>
            @endif

        </div>
    </section>


    {{-- ══════════════════════════════════
         PROJECT GRID
    ══════════════════════════════════ --}}
    <main class="relative z-10 px-6 pb-40">
        <div class="max-w-[1200px] mx-auto">

            @if ($projects->isEmpty())
            <div class="text-center py-32">
                <p class="text-5xl font-black text-white/[0.04] mb-4" style="font-family:'Bebas Neue',sans-serif;">NO RESULTS</p>
                <p class="text-sm text-white/25 font-light">Try adjusting your filters or search terms.</p>
            </div>
            @else

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-14">
                @foreach ($projects as $index => $project)
                <div class="reveal project-card" style="--delay:{{ ($index % 9) * 60 }}ms">
                    <a href="{{ route('works.show', $project->slug) }}" class="block">

                        {{-- Thumbnail --}}
                        <div class="project-thumb"
                            onmouseenter="const v = this.querySelector('video'); if(v) { v.play(); this.timer = setTimeout(() => v.pause(), 8000); }"
                            onmouseleave="const v = this.querySelector('video'); if(v) { clearTimeout(this.timer); v.pause(); v.currentTime = 0; }">

                            @php $displayImage = $project->cover_image ?? $project->image; @endphp
                            @if ($displayImage)
                                @php
                                    $fileUrl = Str::startsWith($displayImage, 'http') ? $displayImage : asset('storage/' . $displayImage);
                                    $ext = strtolower(pathinfo($displayImage, PATHINFO_EXTENSION));
                                    $isVideo = in_array($ext, ['mp4','webm','ogg','mov','avi','mkv']);
                                @endphp
                                @if ($isVideo)
                                <div class="absolute top-3 right-3 z-20 w-6 h-6 flex items-center justify-center bg-black/50 backdrop-blur-sm rounded-full border border-white/10">
                                    <svg class="w-3 h-3 text-white/80" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                                <video src="{{ $fileUrl }}" muted loop playsinline class="w-full h-full object-cover"></video>
                                @else
                                <img src="{{ $fileUrl }}" class="w-full h-full object-cover">
                                @endif
                            @endif

                            {{-- Index badge --}}
                            <div class="absolute top-4 left-4 z-10">
                                <span class="text-[9px] font-mono text-white/25">{{ sprintf('%02d', $index + 1) }}</span>
                            </div>

                            {{-- Overlay --}}
                            <div class="thumb-overlay">
                                <span class="view-btn">View Case</span>
                            </div>

                            {{-- Bottom sweep --}}
                            <div class="thumb-sweep"></div>
                        </div>

                        {{-- Meta --}}
                        <div class="mt-4 flex items-start justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base font-semibold text-white/65 group-hover:text-white transition-colors duration-300 mb-1.5 truncate tracking-tight">
                                    {{ $project->title }}
                                </h4>
                                <div class="flex items-center gap-2">
                                    <span class="text-[9px] font-bold uppercase tracking-[0.25em] text-cyan-400/50">
                                        {{ $project->category ?? 'Video Editing' }}
                                    </span>
                                    <span class="w-2 h-px bg-white/10"></span>
                                    <span class="text-[9px] font-mono text-white/20">{{ $project->year ?? '2026' }}</span>
                                </div>
                            </div>
                            <div class="arrow-icon mt-0.5">
                                <svg class="w-3 h-3 text-white/20 transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-24 pt-10 flex justify-center" style="border-top: 1px solid rgba(255,255,255,0.05);">
                {{ $projects->links() }}
            </div>

            @endif
        </div>
    </main>


    {{-- ══════════════════════════════════
         FOOTER CTA
    ══════════════════════════════════ --}}
    <footer class="footer-aurora relative z-10 px-6 pt-32 pb-20">

        {{-- Aurora blobs inside footer --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="aurora-blob w-[600px] h-[600px] opacity-[0.12]" style="background: radial-gradient(circle, #67e8f9, transparent 60%); top: -100px; left: -100px; animation: auroraFloat 15s ease-in-out infinite;"></div>
            <div class="aurora-blob w-[500px] h-[500px] opacity-[0.10]" style="background: radial-gradient(circle, #818cf8, transparent 60%); bottom: -50px; right: -50px; animation: auroraFloat2 18s ease-in-out infinite;"></div>
        </div>

        {{-- Wave top divider --}}
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-none">
            <svg viewBox="0 0 1440 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-16 md:h-24">
                <path d="M0,0 L1440,0 L1440,40 C1300,90 1150,100 1000,75 C850,50 700,20 550,50 C400,80 250,100 100,70 L0,50 Z" fill="#050507"/>
            </svg>
        </div>

        <div class="max-w-[680px] mx-auto text-center relative z-10">

            <div class="reveal pill-label mx-auto mb-8 w-fit">Collaboration</div>

            <h2 class="reveal text-[clamp(2.5rem,8vw,6rem)] font-black leading-[0.88] text-white mb-6"
                style="font-family:'Bebas Neue','Arial Black',sans-serif; --delay:60ms">
                LET'S MAKE IT<br><span class="gradient-text">HAPPEN.</span>
            </h2>

            <p class="reveal text-sm text-white/35 font-light leading-relaxed max-w-xs mx-auto mb-12" style="--delay:120ms">
                Ready to start your next project? I'm open to new work and creative collaborations.
            </p>

            <div class="reveal flex items-center justify-center gap-4 flex-wrap" style="--delay:180ms">
                <a href="{{ route('home') }}#contact" class="btn-primary-sm">
                    Tell Me About Your Project
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
                <a href="{{ route('about') }}" wire:navigate class="btn-outline-sm">
                    About Me
                </a>
            </div>

            <div class="reveal mt-16 pt-8" style="--delay:220ms; border-top: 1px solid rgba(255,255,255,0.05);">
                <p class="text-[9px] font-bold uppercase tracking-[0.5em] text-white/15">Jakarta · Indonesia · © 2026</p>
            </div>
        </div>
    </footer>


    <script>
        const revealEls = document.querySelectorAll('.reveal');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
            });
        }, { threshold: 0.07, rootMargin: '0px 0px -20px 0px' });
        revealEls.forEach(el => io.observe(el));
    </script>

</div>