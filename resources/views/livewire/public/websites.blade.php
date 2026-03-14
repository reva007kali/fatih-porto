<div class="min-h-screen bg-[#070708] text-[#e5e5e5] antialiased selection:bg-orange-500 selection:text-white overflow-x-hidden">

    @section('meta_title', 'Websites Gallery | Reva Adhitya')
    @section('meta_description', 'A showcase of static websites and landing pages, designed for performance and aesthetic impact.')
    @section('meta_keywords', 'Websites, Landing Pages, Web Design, Reva Adhitya, Portfolio')

    {{-- Ambient BG --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[40vw] font-black text-white/[0.015] select-none uppercase leading-none tracking-tighter">
            Web
        </div>
    </div>

    {{-- Header --}}
    <header class="relative z-10 pt-48 pb-32 px-6 md:px-20">
        <div class="max-w-[1440px] mx-auto">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-px bg-orange-500/50"></div>
                <span class="text-[10px] uppercase tracking-[0.5em] font-bold text-white/40">Web Gallery / 2026</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-end">
                <div class="lg:col-span-8">
                    <h1 class="text-[12vw] md:text-[10vw] font-black tracking-[-0.05em] leading-[0.8] text-white uppercase"
                        style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                        Website<br/>
                        <span class="text-transparent hover:text-white transition-colors duration-1000"
                            style="-webkit-text-stroke: 1.5px rgba(255,255,255,0.2);">Gallery.</span>
                    </h1>
                </div>
                <div class="lg:col-span-4 pb-4">
                    <p class="text-lg text-white/40 leading-relaxed font-light max-w-sm">
                        A showcase of static websites and landing pages, designed for performance and aesthetic impact.
                    </p>
                </div>
            </div>
        </div>
    </header>

    {{-- Filters --}}
    <section class="relative z-10 px-6 md:px-20 mb-24">
        <div class="max-w-[1440px] mx-auto">

            {{-- Search --}}
            <div class="relative group mb-3">
                <input wire:model.live.debounce.300ms="search" type="text"
                    placeholder="Search websites..."
                    class="w-full bg-[#0d0d0e] border border-white/[0.07] text-white text-sm font-light
                           pl-12 pr-12 py-4 placeholder-white/20
                           focus:outline-none focus:border-orange-500/50 focus:bg-[#111]
                           transition-all duration-300">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/20 group-focus-within:text-orange-500 transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <div class="absolute bottom-0 left-0 h-px w-0 bg-gradient-to-r from-orange-600 to-amber-400 group-focus-within:w-full transition-all duration-500"></div>
            </div>

            {{-- Tag pills --}}
            <div class="bg-[#0d0d0e] border border-white/[0.07] p-3 flex flex-wrap gap-2 items-center">
                <span class="text-[8px] font-bold uppercase tracking-[0.3em] text-white/20 mr-1 flex-shrink-0">Tag</span>
                <button wire:click="$set('tag', '')"
                    class="px-3 py-1.5 text-[9px] font-bold uppercase tracking-[0.2em] border transition-all duration-200
                           {{ !$tag ? 'bg-orange-500 border-orange-500 text-white' : 'border-white/10 text-white/40 hover:border-white/30 hover:text-white' }}">
                    All
                </button>
                @foreach ($allTags as $t)
                    <button wire:click="$set('tag', '{{ $t }}')"
                        class="px-3 py-1.5 text-[9px] font-bold uppercase tracking-[0.2em] border transition-all duration-200
                               {{ $tag === $t ? 'bg-orange-500 border-orange-500 text-white' : 'border-white/10 text-white/40 hover:border-white/30 hover:text-white' }}">
                        {{ $t }}
                    </button>
                @endforeach
            </div>

            {{-- Active tag summary --}}
            @if($search || $tag)
                <div class="mt-3 flex items-center gap-3 flex-wrap">
                    <span class="text-[9px] uppercase tracking-[0.3em] text-white/20">Filtering by</span>
                    @if($search)
                        <button wire:click="$set('search', '')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/5 border border-white/10
                                   text-[9px] font-bold text-white/50 hover:border-orange-500/50 hover:text-orange-400 transition-all duration-200">
                            <span>"{{ $search }}"</span>
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    @endif
                    @if($tag)
                        <button wire:click="$set('tag', '')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-orange-500/10 border border-orange-500/30
                                   text-[9px] font-bold text-orange-400 hover:bg-orange-500/20 transition-all duration-200">
                            <span>{{ $tag }}</span>
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    @endif
                    <button wire:click="$set('search', ''); $set('tag', '')"
                        class="text-[9px] uppercase tracking-[0.25em] text-white/20 hover:text-orange-400 transition-colors duration-200">
                        Clear all
                    </button>
                </div>
            @endif
        </div>
    </section>

    {{-- Grid --}}
    <main class="relative z-10 px-6 md:px-20 pb-40">
        <div class="max-w-[1440px] mx-auto">

            @if($websites->isEmpty())
                <div class="text-center py-20 border border-dashed border-white/[0.07]">
                    <p class="text-white/20 text-sm uppercase tracking-[0.3em]">No websites found.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16">
                    @foreach ($websites as $i => $website)
                        <div class="group">
                            <a href="{{ route('websites.show', $website->slug) }}" class="block">

                                {{-- Image --}}
                                <div class="relative aspect-[5/3] overflow-hidden bg-[#111] border border-white/[0.06]
                                            group-hover:border-orange-500/30 transition-colors duration-500">
                                    @if ($website->image)
                                        <img src="{{ asset('storage/' . $website->image) }}"
                                            class="w-full h-full object-cover scale-105 group-hover:scale-100 transition-all duration-[1.5s] ease-out">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-[#1a1a1a]">
                                            <span class="text-6xl font-black text-white/[0.04]"
                                                style="font-family:'Bebas Neue',sans-serif;">{{ substr($website->title, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    {{-- Index --}}
                                    <div class="absolute top-4 left-4">
                                        <span class="text-[9px] font-mono text-white/30 group-hover:text-orange-400 transition-colors duration-300">
                                            {{ sprintf('%02d', $i + 1) }}
                                        </span>
                                    </div>

                                    {{-- Tags on hover --}}
                                    @if ($website->tags)
                                        <div class="absolute top-3 right-3 flex flex-wrap gap-1.5
                                                    opacity-0 group-hover:opacity-100 translate-y-1 group-hover:translate-y-0
                                                    transition-all duration-300">
                                            @foreach (array_slice($website->tags, 0, 2) as $tag)
                                                <span class="px-2 py-1 bg-[#0a0a0a]/90 backdrop-blur-sm border border-white/20
                                                             text-[8px] font-bold uppercase tracking-[0.15em] text-white/50">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- Hover overlay --}}
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100
                                                transition-opacity duration-500 bg-black/40 backdrop-blur-[2px]">
                                        <span class="px-6 py-2.5 border border-white text-[9px] font-black uppercase tracking-widest bg-white text-black">
                                            View Site
                                        </span>
                                    </div>

                                    {{-- Bottom sweep --}}
                                    <div class="absolute bottom-0 left-0 h-px w-0 bg-gradient-to-r from-orange-600 to-amber-400 group-hover:w-full transition-all duration-700"></div>
                                </div>

                                {{-- Meta --}}
                                <div class="mt-5 flex items-start justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-bold tracking-tight text-white/70
                                                   group-hover:text-white transition-colors duration-300 mb-1.5 truncate">
                                            {{ $website->title }}
                                        </h3>
                                        <p class="text-xs text-white/25 line-clamp-1 font-light leading-relaxed">
                                            {{ $website->description }}
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 w-7 h-7 border border-white/10 flex items-center justify-center mt-0.5
                                                group-hover:bg-white group-hover:border-white transition-all duration-300">
                                        <svg class="w-3 h-3 text-white/30 group-hover:text-black
                                                    group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all duration-200"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-28 pt-10 border-t border-white/[0.06]">
                    {{ $websites->links() }}
                </div>
            @endif

        </div>
    </main>

    <style>
        h1,h2,h3,h4{text-rendering:optimizeLegibility;-webkit-font-smoothing:antialiased;}
        ::-webkit-scrollbar{width:4px;}
        ::-webkit-scrollbar-track{background:#070708;}
        ::-webkit-scrollbar-thumb{background:#1a1a1c;}
        ::-webkit-scrollbar-thumb:hover{background:#f97316;}
        .pagination{display:flex;gap:8px;font-family:monospace;font-size:10px;}
        .page-item.active .page-link{background:white;color:black;border-color:white;}
        .page-link{border:1px solid rgba(255,255,255,0.1);padding:8px 14px;color:rgba(255,255,255,0.4);transition:all 0.2s;}
        .page-link:hover{background:#f97316;border-color:#f97316;color:white;}
    </style>

</div>