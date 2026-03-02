<div class="min-h-screen bg-[#0b0b0d] text-white antialiased selection:bg-orange-500 selection:text-white">

    @section('meta_title', 'Selected Works | Reva Adhitya')
    @section('meta_description', 'A collection of digital experiences built with precision, focusing on aesthetic impact and technical performance.')
    @section('meta_keywords', 'Works, Projects, Portfolio, Case Studies, Reva Adhitya')

    {{-- 1. Premium Ambient Background --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        {{-- Large Background Text --}}
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[25vw] font-black text-white/[0.01] select-none uppercase leading-none">
            Gallery
        </div>
    </div>

    {{-- 2. Refined Header --}}
    <header class="relative pt-32 pb-20 px-6 flex flex-col items-center">
        <div
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/[0.03] border border-white/5 backdrop-blur-md mb-8">
            <span class="relative flex h-2 w-2">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                <span
                    class="relative inline-flex rounded-full h-2 w-2 bg-orange-500 shadow-[0_0_10px_rgba(255,107,0,1)]"></span>
            </span>
            <span class="text-[10px] uppercase tracking-[0.3em] font-black text-white/60">Live Portfolio</span>
        </div>

        <h1 class="text-5xl md:text-8xl font-black tracking-tighter text-white mb-6 text-center leading-none">
            Selected <span
                class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Works.</span>
        </h1>

        <p class="text-lg md:text-xl text-white/40 text-center max-w-xl leading-relaxed mb-12">
            A collection of digital experiences built with precision, focusing on aesthetic impact and technical
            performance.
        </p>

        {{-- Archive Link --}}
        <div class="mb-12">
            <a href="{{ route('archive') }}" wire:navigate
                class="text-[10px] font-black uppercase tracking-[0.3em] text-orange-500 hover:text-white transition-colors border-b border-orange-500/30 hover:border-white pb-1">
                View Archived Projects →
            </a>
        </div>

        {{-- Filters Section --}}
        <div class="w-full max-w-4xl mx-auto flex flex-col md:flex-row gap-4">
            {{-- Search --}}
            <div class="relative flex-grow group">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search projects..."
                    class="w-full pl-12 pr-4 py-4 bg-[#161618] border border-white/10 rounded-full text-white placeholder-white/30 focus:outline-none focus:border-orange-500/50 transition-all duration-300">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/30 group-focus-within:text-orange-500 transition-colors"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            {{-- Category Filter --}}
            <div class="relative min-w-[200px]">
                <select wire:model.live="category"
                    class="w-full appearance-none px-6 py-4 bg-[#161618] border border-white/10 rounded-full text-white focus:outline-none focus:border-orange-500/50 cursor-pointer transition-all duration-300">
                    <option value="">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>

            {{-- Year Filter --}}
            <div class="relative min-w-[150px]">
                <select wire:model.live="year"
                    class="w-full appearance-none px-6 py-4 bg-[#161618] border border-white/10 rounded-full text-white focus:outline-none focus:border-orange-500/50 cursor-pointer transition-all duration-300">
                    <option value="">All Years</option>
                    @foreach ($years as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </select>
                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </header>

    {{-- 3. Projects Grid --}}
    <main class="relative px-6 pb-32 max-w-7xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
            @foreach ($projects as $index => $project)
                <div class="group h-full perspective-1000"> {{-- Perspective adds depth --}}
                    <a href="{{ route('works.show', $project->slug) }}"
                        class="relative flex flex-col h-full rounded-[28px] overflow-hidden bg-[#161618] border border-white/5 
                       {{-- Hardware Acceleration & Smoothness --}}
                       transform-gpu will-change-transform 
                       transition-all duration-500 ease-[cubic-bezier(0.23,1,0.32,1)]
                       hover:border-orange-500/10 hover:-translate-y-3 hover:shadow-[0_30px_60px_-15px_rgba(255,107,0,0.1)] block">

                        {{-- Image Container --}}
                        <div class="relative aspect-[4/3] md:aspect-[4/3] overflow-hidden">
                            @if ($project->image)
                                <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}"
                                    class="w-full h-full object-cover 
                                   {{-- Match duration with parent for sync --}}
                                   transform-gpu transition-transform duration-500 ease-[cubic-bezier(0.23,1,0.32,1)]
                                   group-hover:scale-105 opacity-80 group-hover:opacity-100">
                            @endif
                            {{-- Gradient Overlay --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#161618] via-transparent to-transparent opacity-60">
                            </div>
                        </div>

                        {{-- Card Content --}}
                        <div class="p-5 md:p-6 flex flex-col flex-grow relative z-10 bg-[#161618]">
                            <div class="mb-4 flex items-center gap-3">
                                <span class="text-orange-500 font-black text-[10px] uppercase tracking-widest">
                                    {{ sprintf('%02d', $index + 1) }}
                                </span>
                                <div class="h-[1px] w-0 group-hover:w-8 bg-orange-500/50 transition-all duration-500">
                                </div>
                            </div>

                            <h4
                                class="text-xl md:text-2xl font-bold text-white mb-4 tracking-tighter group-hover:text-orange-500 transition-colors duration-500">
                                {{ $project->title }}
                            </h4>

                            {{-- Bottom Link Indicator --}}
                            <div class="flex items-center gap-3 mt-auto">
                                <span
                                    class="text-[10px] font-black uppercase tracking-[0.3em] text-white/20 group-hover:text-orange-500 transition-colors duration-500">Discover</span>
                                <div
                                    class="h-[1px] flex-grow bg-white/5 group-hover:bg-orange-500/20 transition-colors duration-500">
                                </div>
                                <div
                                    class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-white/30 
                                    group-hover:bg-orange-500 group-hover:text-black group-hover:border-orange-500 
                                    transform-gpu transition-all duration-500">
                                    →
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-14">
            {{ $projects->links() }}
        </div>

        {{-- 4. Bottom Call-to-Action --}}
        <section
            class="mt-32 p-12 md:p-20 rounded-[60px] bg-white/5 border border-white/10 overflow-hidden relative text-center">
            <div class="absolute top-0 right-0 w-64 h-64 bg-orange-600/10 blur-[80px] -mr-32 -mt-32"></div>

            <h3 class="text-3xl md:text-5xl font-black tracking-tighter text-white mb-8">Have a project in mind?</h3>
            <a href="#contact" class="inline-flex items-center gap-6 group">
                <div
                    class="w-16 h-16 rounded-full bg-orange-500 flex items-center justify-center text-black text-xl transition-transform group-hover:scale-110">
                    →
                </div>
                <span
                    class="text-xl md:text-2xl font-black text-white border-b-2 border-white/10 group-hover:border-orange-500 transition-all pb-1">Let's
                    build it together</span>
            </a>
        </section>
    </main>

    <style>
        /* Prevent image stretching in staggered grids if needed */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

</div>
