<div class="min-h-screen bg-[#070708] text-[#e5e5e5] antialiased selection:bg-white selection:text-black overflow-x-hidden">

    @section('meta_title', 'Selected Works | Reva Adhitya')
    @section('meta_description', 'A collection of digital experiences built with precision, focusing on aesthetic impact and technical performance.')
    @section('meta_keywords', 'Works, Projects, Portfolio, Case Studies, Reva Adhitya')

    {{-- 1. Premium Ambient Background (Editorial Style) --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[40vw] font-black text-white/[0.02] select-none uppercase leading-none tracking-tighter">
            Works
        </div>
    </div>

    {{-- 2. Massive Editorial Header --}}
    <header class="relative pt-48 pb-32 px-6 md:px-20 z-10">
        <div class="max-w-[1440px] mx-auto">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-[1px] bg-white/20"></div>
                <span class="text-[10px] uppercase tracking-[0.5em] font-bold text-white/40">Curated Gallery / 2026</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-end">
                <div class="lg:col-span-8">
                    <h1 class="text-[12vw] md:text-[10vw] font-black tracking-[calc(-0.05em)] leading-[0.8] text-white uppercase">
                        Selected<br/>
                        <span class="text-white/20 hover:text-white transition-colors duration-1000">Works.</span>
                    </h1>
                </div>
                <div class="lg:col-span-4 pb-4">
                    <p class="text-xl text-white/40 leading-relaxed font-light max-w-sm">
                        Digital experiences built with technical precision and editorial aesthetic impact.
                    </p>
                </div>
            </div>

            {{-- Archive Link (Minimalist) --}}
            <div class="mt-20">
                <a href="{{ route('archive') }}" wire:navigate
                    class="group inline-flex items-center gap-4 text-[10px] font-black uppercase tracking-[0.4em] text-white/60 hover:text-white transition-all">
                    <span>Archived Projects</span>
                    <span class="w-8 h-[1px] bg-white/20 group-hover:w-12 group-hover:bg-white transition-all"></span>
                    <span class="opacity-0 group-hover:opacity-100 -translate-x-4 group-hover:translate-x-0 transition-all">→</span>
                </a>
            </div>
        </div>
    </header>

    {{-- 3. High-Contrast Filters --}}
    <section class="relative z-10 px-6 md:px-20 mb-24">
        <div class="max-w-[1440px] mx-auto">
            <div class="flex flex-col lg:flex-row gap-0 border-y border-white/10">
                {{-- Search --}}
                <div class="flex-grow relative border-b lg:border-b-0 lg:border-r border-white/10 group">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Filter by project name..."
                        class="w-full pl-16 pr-8 py-10 bg-transparent text-2xl font-light text-white placeholder-white/10 focus:outline-none transition-all">
                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-white/20 group-focus-within:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                </div>

                {{-- Category Filter --}}
                <div class="relative min-w-[280px] border-b lg:border-b-0 lg:border-r border-white/10 group">
                    <label class="absolute top-4 left-6 text-[8px] uppercase tracking-widest text-white/30">Category</label>
                    <select wire:model.live="category"
                        class="w-full appearance-none px-6 pt-10 pb-6 bg-transparent text-white focus:outline-none cursor-pointer uppercase text-xs font-bold tracking-widest">
                        <option value="" class="bg-black">All Sectors</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" class="bg-black">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Year Filter --}}
                <div class="relative min-w-[180px] group">
                    <label class="absolute top-4 left-6 text-[8px] uppercase tracking-widest text-white/30">Release</label>
                    <select wire:model.live="year"
                        class="w-full appearance-none px-6 pt-10 pb-6 bg-transparent text-white focus:outline-none cursor-pointer font-mono text-xs">
                        <option value="" class="bg-black">All Years</option>
                        @foreach ($years as $y)
                            <option value="{{ $y }}" class="bg-black">{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. Projects Editorial Grid --}}
    <main class="relative z-10 px-6 md:px-20 pb-40">
        <div class="max-w-[1440px] mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-24">
                @foreach ($projects as $index => $project)
                    <div class="group">
                        <a href="{{ route('works.show', $project->slug) }}" class="block">
                            {{-- Image Component: B&W to Color Cinematic --}}
                            <div class="relative aspect-[5/3] overflow-hidden bg-zinc-900 border border-white/5">
                                @php
                                    $displayImage = $project->cover_image ?? $project->image;
                                @endphp
                                @if ($displayImage)
                                    <img src="{{ Str::startsWith($displayImage, 'http') ? $displayImage : asset('storage/' . $displayImage) }}"
                                        class="w-full h-full object-cover scale-110 group-hover:scale-100 transition-all duration-[1.5s] ease-out">
                                @endif
                                
                                {{-- Subtle Numbering Overlay --}}
                                <div class="absolute top-8 left-8 mix-blend-difference">
                                    <span class="text-xs font-mono text-white/40 group-hover:text-white transition-colors">
                                        [{{ sprintf('%02d', $index + 1) }}]
                                    </span>
                                </div>

                                {{-- View Project Prompt --}}
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-700 bg-black/40 backdrop-blur-[2px]">
                                    <span class="px-8 py-3 rounded-full border border-white text-[10px] font-black uppercase tracking-widest bg-white text-black">
                                        View Case
                                    </span>
                                </div>
                            </div>

                            {{-- Project Meta --}}
                            <div class="mt-8 flex justify-between items-start gap-4">
                                <div>
                                    <h4 class="text-3xl font-bold tracking-tighter text-white group-hover:text-white/60 transition-colors duration-500 mb-2">
                                        {{ $project->title }}
                                    </h4>
                                    <div class="flex items-center gap-3">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-white/30">{{ $project->category ?? 'Web Development' }}</span>
                                        <span class="w-4 h-[1px] bg-white/10"></span>
                                        <span class="text-[10px] font-mono text-white/20">{{ $project->year ?? '2026' }}</span>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <svg class="w-5 h-5 text-white/20 -rotate-45 group-hover:rotate-0 group-hover:text-white transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Custom Pagination Styling --}}
            <div class="mt-32 pt-12 border-t border-white/5">
                {{ $projects->links() }}
            </div>
        </div>
    </main>

    {{-- 5. Footer CTA: Kinetic Typography --}}
    <footer class="relative min-h-[70vh] flex flex-col items-center justify-center bg-white text-black rounded-t-[50px] md:rounded-t-[120px] px-6 text-center overflow-hidden">
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] select-none pointer-events-none">
            <span class="text-[35vw] font-black tracking-tighter uppercase">Next</span>
        </div>

        <div class="relative z-10">
            <h3 class="text-xs font-black uppercase tracking-[0.6em] mb-12 opacity-40 italic underline underline-offset-8">Collaboration</h3>
            <h2 class="text-6xl md:text-[8vw] font-black tracking-[calc(-0.05em)] leading-[0.9] mb-16">
                Let's make it<br/>happen together.
            </h2>
            
            <a href="#contact" class="group relative inline-flex items-center gap-8 px-12 py-6">
                <span class="text-2xl md:text-4xl font-black uppercase tracking-tighter group-hover:pr-10 transition-all duration-700">
                    Tell me about your project
                </span>
                <div class="w-16 h-16 rounded-full border border-black flex items-center justify-center group-hover:bg-black group-hover:text-white transition-all duration-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>
        </div>
    </footer>

    <style>
        /* Editorial Typography Tweaks */
        h1, h2, h3, h4 { text-rendering: optimizeLegibility; -webkit-font-smoothing: antialiased; }
        
        /* Hide default scrollbar for a cleaner editorial look */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #070708; }
        ::-webkit-scrollbar-thumb { background: #1a1a1c; }
        ::-webkit-scrollbar-thumb:hover { background: #e5e5e5; }

        /* Smooth reveal for pagination */
        .pagination { @apply flex gap-2 font-mono text-[10px]; }
        .page-item.active .page-link { @apply bg-white text-black border-white; }
        .page-link { @apply border border-white/10 px-4 py-2 hover:bg-white hover:text-black transition-colors; }
    </style>

</div>