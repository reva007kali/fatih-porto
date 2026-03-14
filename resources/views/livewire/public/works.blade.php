<div
    class="min-h-screen bg-[#070708] text-[#e5e5e5] antialiased selection:bg-orange-500 selection:text-white overflow-x-hidden">

    @section('meta_title', 'Selected Works | Reva Adhitya')
    @section('meta_description',
        'A collection of digital experiences built with precision, focusing on aesthetic impact
        and technical performance.')
    @section('meta_keywords', 'Works, Projects, Portfolio, Case Studies, Reva Adhitya')

    {{-- Ambient BG --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[40vw] font-black text-white/[0.02] select-none uppercase leading-none tracking-tighter">
            Works
        </div>
    </div>

    {{-- Editorial Header --}}
    <header class="relative pt-48 pb-32 px-6 md:px-20 z-10">
        <div class="max-w-[1440px] mx-auto">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-px bg-orange-500/50"></div>
                <span class="text-[10px] uppercase tracking-[0.5em] font-bold text-white/40">Curated Gallery /
                    2026</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-end">
                <div class="lg:col-span-8">
                    <h1 class="text-[12vw] md:text-[10vw] font-black leading-[0.8] text-white uppercase"
                        style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                        Selected<br />
                        <span
                            class="bg-gradient-to-r from-orange-600 via-orange-500 to-orange-400 text-transparent bg-clip-text ">Works.</span>
                    </h1>
                </div>
                <div class="lg:col-span-4 pb-4">
                    <p class="text-lg text-white/40 leading-relaxed font-light max-w-sm">
                        Digital experiences built with technical precision and editorial aesthetic impact.
                    </p>
                </div>
            </div>

            <div class="mt-20">
                <a href="{{ route('archive') }}" wire:navigate
                    class="group inline-flex items-center gap-4 text-[10px] font-black uppercase tracking-[0.4em] text-white/40 hover:text-orange-400 transition-all">
                    <span>Archived Projects</span>
                    <span class="w-8 h-px bg-white/20 group-hover:w-12 group-hover:bg-orange-500 transition-all"></span>
                    <span
                        class="opacity-0 group-hover:opacity-100 -translate-x-4 group-hover:translate-x-0 transition-all text-orange-400">→</span>
                </a>
            </div>
        </div>
    </header>

    {{-- Filters --}}
    <section class="relative z-10 px-6 md:px-20 mb-24">
        <div class="max-w-[1440px] mx-auto">

            {{-- Search bar --}}
            <div class="relative group mb-3">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search projects..."
                    class="w-full bg-[#0d0d0e] border border-white/[0.07] text-white text-sm font-light
                       pl-12 pr-12 py-4 placeholder-white/20
                       focus:outline-none focus:border-orange-500/50 focus:bg-[#111]
                       transition-all duration-300">

                {{-- Search icon --}}
                <span
                    class="absolute left-4 top-1/2 -translate-y-1/2 text-white/20 group-focus-within:text-orange-500 transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>

                {{-- Clear button --}}
                <button wire:click="$set('search', '')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-white/20 hover:text-white transition-colors duration-200
                       opacity-0 group-focus-within:opacity-100"
                    x-show="$wire.search !== ''" x-cloak>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                {{-- Orange bottom line on focus --}}
                <div
                    class="absolute bottom-0 left-0 h-px w-0 bg-gradient-to-r from-orange-600 to-amber-400 group-focus-within:w-full transition-all duration-500">
                </div>
            </div>

            {{-- Category + Year pill filters --}}
            <div class="flex flex-col sm:flex-row gap-3">

                {{-- Category pills --}}
                <div class="flex-1 bg-[#0d0d0e] border border-white/[0.07] p-3 flex flex-wrap gap-2 items-center">
                    <span
                        class="text-[8px] font-bold uppercase tracking-[0.3em] text-white/20 mr-1 flex-shrink-0">Category</span>
                    <button wire:click="$set('category', '')"
                        class="px-3 py-1.5 text-[9px] font-bold uppercase tracking-[0.2em] border transition-all duration-200
                           {{ !$category ? 'bg-orange-500 border-orange-500 text-white' : 'border-white/10 text-white/40 hover:border-white/30 hover:text-white' }}">
                        All
                    </button>
                    @foreach ($categories as $cat)
                        <button wire:click="$set('category', '{{ $cat }}')"
                            class="px-3 py-1.5 text-[9px] font-bold uppercase tracking-[0.2em] border transition-all duration-200
                               {{ $category === $cat ? 'bg-orange-500 border-orange-500 text-white' : 'border-white/10 text-white/40 hover:border-white/30 hover:text-white' }}">
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>

                {{-- Year pills --}}
                <div class="sm:w-auto bg-[#0d0d0e] border border-white/[0.07] p-3 flex flex-wrap gap-2 items-center">
                    <span
                        class="text-[8px] font-bold uppercase tracking-[0.3em] text-white/20 mr-1 flex-shrink-0">Year</span>
                    <button wire:click="$set('year', '')"
                        class="px-3 py-1.5 text-[9px] font-bold font-mono border transition-all duration-200
                           {{ !$year ? 'bg-orange-500 border-orange-500 text-white' : 'border-white/10 text-white/40 hover:border-white/30 hover:text-white' }}">
                        All
                    </button>
                    @foreach ($years as $y)
                        <button wire:click="$set('year', '{{ $y }}')"
                            class="px-3 py-1.5 text-[9px] font-bold font-mono border transition-all duration-200
                               {{ $year == $y ? 'bg-orange-500 border-orange-500 text-white' : 'border-white/10 text-white/40 hover:border-white/30 hover:text-white' }}">
                            {{ $y }}
                        </button>
                    @endforeach
                </div>

            </div>

            {{-- Active filter summary --}}
            @if ($search || $category || $year)
                <div class="mt-3 flex items-center gap-3 flex-wrap">
                    <span class="text-[9px] uppercase tracking-[0.3em] text-white/20">Filtering by</span>

                    @if ($search)
                        <button wire:click="$set('search', '')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/5 border border-white/10
                               text-[9px] font-bold text-white/50 hover:border-orange-500/50 hover:text-orange-400 transition-all duration-200 group/tag">
                            <span>"{{ $search }}"</span>
                            <svg class="w-2.5 h-2.5 group-hover/tag:text-orange-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    @endif

                    @if ($category)
                        <button wire:click="$set('category', '')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-orange-500/10 border border-orange-500/30
                               text-[9px] font-bold text-orange-400 hover:bg-orange-500/20 transition-all duration-200 group/tag">
                            <span>{{ $category }}</span>
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    @endif

                    @if ($year)
                        <button wire:click="$set('year', '')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-orange-500/10 border border-orange-500/30
                               text-[9px] font-bold font-mono text-orange-400 hover:bg-orange-500/20 transition-all duration-200 group/tag">
                            <span>{{ $year }}</span>
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    @endif

                    <button wire:click="$set('search', ''); $set('category', ''); $set('year', '')"
                        class="text-[9px] uppercase tracking-[0.25em] text-white/20 hover:text-orange-400 transition-colors duration-200 ml-1">
                        Clear all
                    </button>
                </div>
            @endif

        </div>
    </section>

    {{-- Projects Grid --}}
    <main class="relative z-10 px-6 md:px-20 pb-40">
        <div class="max-w-[1440px] mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16">
                @foreach ($projects as $index => $project)
                    <div class="group">
                        <a href="{{ route('works.show', $project->slug) }}" class="block">

                            {{-- Image --}}
                            <div class="relative aspect-[5/3] overflow-hidden bg-[#111] border border-white/[0.06] group-hover:border-orange-500/30 transition-colors duration-500"
                                onmouseenter="const v = this.querySelector('video'); if(v) { v.play(); this.timer = setTimeout(() => v.pause(), 8000); }"
                                onmouseleave="const v = this.querySelector('video'); if(v) { clearTimeout(this.timer); v.pause(); v.currentTime = 0; }">
                                @php $displayImage = $project->cover_image ?? $project->image; @endphp
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
                                            class="w-full h-full object-cover scale-110 group-hover:scale-100 transition-all duration-[1.5s] ease-out"></video>
                                    @else
                                        <img src="{{ $fileUrl }}"
                                            class="w-full h-full object-cover scale-110 group-hover:scale-100 transition-all duration-[1.5s] ease-out">
                                    @endif
                                @endif

                                {{-- Index --}}
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="text-[9px] font-mono text-white/30 group-hover:text-orange-400 transition-colors duration-300">
                                        {{ sprintf('%02d', $index + 1) }}
                                    </span>
                                </div>

                                {{-- Hover overlay --}}
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-black/50 backdrop-blur-[2px]">
                                    <span
                                        class="px-6 py-2.5 border border-white text-[9px] font-black uppercase tracking-widest bg-white text-black">
                                        View Case
                                    </span>
                                </div>

                                {{-- Orange bottom sweep --}}
                                <div
                                    class="absolute bottom-0 left-0 h-px w-0 bg-gradient-to-r from-orange-600 to-amber-400 group-hover:w-full transition-all duration-700">
                                </div>
                            </div>

                            {{-- Meta --}}
                            <div class="mt-5 flex justify-between items-start gap-4">
                                <div class="flex-1 min-w-0">
                                    <h4
                                        class="text-base font-bold tracking-tight text-white/70 group-hover:text-white transition-colors duration-300 mb-2 truncate">
                                        {{ $project->title }}
                                    </h4>
                                    <div class="flex items-center gap-2.5">
                                        <span
                                            class="text-[9px] font-bold uppercase tracking-[0.25em] text-orange-400/60">
                                            {{ $project->category ?? 'Web Development' }}
                                        </span>
                                        <span class="w-3 h-px bg-white/10"></span>
                                        <span class="text-[9px] font-mono text-white/20">
                                            {{ $project->year ?? '2026' }}
                                        </span>
                                    </div>
                                </div>
                                <div
                                    class="flex-shrink-0 w-7 h-7 border border-white/10 flex items-center justify-center
                                            group-hover:bg-white group-hover:border-white transition-all duration-300 mt-0.5">
                                    <svg class="w-3 h-3 text-white/30 group-hover:text-black group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all duration-200"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-28 pt-10 border-t border-white/[0.06]">
                {{ $projects->links() }}
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer
        class="relative min-h-[70vh] flex flex-col items-center justify-center bg-white text-black rounded-t-[50px] md:rounded-t-[120px] px-6 text-center overflow-hidden">
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] select-none pointer-events-none">
            <span class="text-[35vw] font-black tracking-tighter uppercase">Next</span>
        </div>
        <div class="relative z-10">
            <h3 class="text-[9px] font-black uppercase tracking-[0.6em] mb-10 opacity-30">Collaboration</h3>
            <h2 class="text-5xl md:text-[8vw] font-black tracking-[-0.04em] leading-[0.9] mb-14"
                style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                Let's make it<br /><span class="text-orange-500">happen together.</span>
            </h2>
            <a href="#contact"
                class="group relative inline-flex items-center gap-6 px-10 py-5 border border-black overflow-hidden">
                <span
                    class="relative z-10 text-sm font-black uppercase tracking-widest group-hover:text-white transition-colors duration-500">
                    Tell me about your project
                </span>
                <div
                    class="w-10 h-10 rounded-full border border-current flex items-center justify-center relative z-10
                            group-hover:border-white group-hover:text-white transition-colors duration-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </div>
                <div
                    class="absolute inset-0 bg-orange-500 translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                </div>
            </a>
        </div>
        <div class="absolute bottom-8 opacity-20">
            <span class="text-[9px] font-bold tracking-[0.5em] uppercase">Jakarta / Indonesia</span>
        </div>
    </footer>

    <style>
        h1,
        h2,
        h3,
        h4 {
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: #070708;
        }

        ::-webkit-scrollbar-thumb {
            background: #1a1a1c;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #f97316;
        }

        .pagination {
            display: flex;
            gap: 8px;
            font-family: monospace;
            font-size: 10px;
        }

        .page-item.active .page-link {
            background: white;
            color: black;
            border-color: white;
        }

        .page-link {
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 8px 14px;
            color: rgba(255, 255, 255, 0.4);
            transition: all 0.2s;
        }

        .page-link:hover {
            background: #f97316;
            border-color: #f97316;
            color: white;
        }
    </style>

</div>
