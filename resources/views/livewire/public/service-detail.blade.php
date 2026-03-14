<div class="min-h-screen bg-[#070708] text-[#e5e5e5] antialiased selection:bg-orange-500 selection:text-white overflow-x-hidden">

    {{-- Back button --}}
    <div class="fixed bottom-8 left-6 md:left-10 z-[100]">
        <button type="button" x-on:click="window.history.back()"
            class="group w-12 h-12 rounded-full border border-white/10 flex items-center justify-center
                   hover:bg-orange-500 hover:border-orange-500 transition-all duration-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
    </div>

    {{-- Page header --}}
    <header class="max-w-[1400px] mx-auto px-5 md:px-10 pt-32 pb-10">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-1.5 h-1.5 rounded-full bg-orange-500"></div>
            <span class="font-mono text-[9px] text-orange-500/70 tracking-[0.3em] uppercase">
                Capability_{{ sprintf('%02d', $service->id) }}
            </span>
            <div class="h-px w-10 bg-white/10"></div>
            <span class="text-[9px] uppercase tracking-[0.3em] text-white/20">Service</span>
        </div>
        <h1 class="text-[clamp(3rem,9vw,8rem)] font-black tracking-[-0.04em] leading-[0.85] uppercase"
            style="font-family:'Bebas Neue','Arial Black',sans-serif;">
            {{ $service->title }}<span class="text-orange-500">.</span>
        </h1>
    </header>

    {{-- ══════════════════════
         BENTO GRID
    ══════════════════════ --}}
    <div class="max-w-[1400px] mx-auto px-5 md:px-10 pb-32">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">

            {{-- [1] Hero icon / visual — wide --}}
            <div class="sm:col-span-2 lg:col-span-8 border border-white/[0.06] bg-[#0d0d0e] overflow-hidden group relative">
                @if ($service->icon)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset('storage/' . $service->icon) }}"
                            class="w-full h-full object-cover scale-105 group-hover:scale-100 transition-transform duration-[1.5s]">
                    </div>
                @else
                    <div class="aspect-video flex items-center justify-center bg-[#111]">
                        <span class="text-[8rem] font-black text-white/[0.03]"
                            style="font-family:'Bebas Neue',sans-serif;">{{ substr($service->title, 0, 1) }}</span>
                    </div>
                @endif
                <div class="absolute bottom-0 left-0 h-px w-0 bg-gradient-to-r from-orange-600 to-amber-400 group-hover:w-full transition-all duration-700"></div>
            </div>

            {{-- [2] Description --}}
            <div class="lg:col-span-4 border border-white/[0.06] bg-[#0d0d0e] p-8 flex flex-col justify-between">
                <div>
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-orange-400/60 mb-4">Overview</p>
                    <p class="text-sm text-white/50 leading-relaxed font-light">
                        {{ Str::limit(strip_tags($service->description), 240) }}
                    </p>
                </div>
                <a href="{{ route('home') }}#contact"
                    class="mt-8 inline-flex items-center gap-2 text-[9px] font-bold uppercase tracking-[0.3em]
                           text-orange-400 hover:text-white transition-colors duration-200 group/link">
                    <span>Start a Project</span>
                    <svg class="w-3 h-3 group-hover/link:translate-x-0.5 group-hover/link:-translate-y-0.5 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                    </svg>
                </a>
            </div>

            {{-- [3] Turnaround stat --}}
            <div class="lg:col-span-3 border border-white/[0.06] bg-[#0d0d0e] p-8 flex flex-col justify-between">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20">Turnaround</p>
                <div>
                    <p class="text-[2.5rem] font-black leading-none text-white/5 mb-1 select-none"
                        style="font-family:'Bebas Neue',sans-serif;">ETA</p>
                    <p class="text-base font-black text-white leading-tight"
                        style="font-family:'Bebas Neue',sans-serif;">{{ $service->turnaround_time ?? '14–28 Days' }}</p>
                </div>
            </div>

            {{-- [4] Features count --}}
            <div class="lg:col-span-2 border border-white/[0.06] bg-[#0d0d0e] p-8 flex flex-col justify-between">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20">Features</p>
                @php $featureCount = count($service->features ?? [1,2,3,4]); @endphp
                <p class="text-5xl font-black text-white/80 leading-none"
                    style="font-family:'Bebas Neue',sans-serif;">{{ sprintf('%02d', $featureCount) }}</p>
            </div>

            {{-- [5] CTA card --}}
            <div class="lg:col-span-3 border border-orange-500/20 bg-orange-500/[0.04] p-8 flex flex-col justify-between">
                <div class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                </div>
                <div>
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-orange-400/60 mb-2">Ready to start?</p>
                    <p class="text-2xl font-black text-white leading-tight mb-5"
                        style="font-family:'Bebas Neue',sans-serif;">Let's Build<br>Together</p>
                    <a href="{{ route('home') }}#contact"
                        class="inline-flex items-center justify-center w-full py-3 bg-orange-500 text-white
                               text-[9px] font-bold uppercase tracking-[0.3em]
                               hover:bg-orange-400 active:scale-[0.98] transition-all duration-200">
                        Book Consultation ↗
                    </a>
                </div>
            </div>

            {{-- [6] Scope of work --}}
            <div class="lg:col-span-4 border border-white/[0.06] bg-[#0d0d0e] p-8">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-8">Scope of Work</p>
                @php
                    $features = $service->features && is_array($service->features) && count($service->features) > 0
                        ? $service->features
                        : ['Strategic Consultation', 'Custom-Tailored Design', 'Performance Optimization', 'Post-Launch Support'];
                @endphp
                <div class="divide-y divide-white/[0.05]">
                    @foreach ($features as $i => $feature)
                        <div class="group/f flex items-center justify-between py-4">
                            <div class="flex items-center gap-3">
                                <span class="text-[8px] font-mono text-orange-500/40 flex-shrink-0">{{ sprintf('%02d', $i + 1) }}</span>
                                <span class="text-xs font-bold text-white/50 group-hover/f:text-white transition-colors duration-200">{{ $feature }}</span>
                            </div>
                            <div class="w-1.5 h-1.5 rounded-full bg-orange-500/20 group-hover/f:bg-orange-500 transition-colors duration-200 flex-shrink-0"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- [7] Service narrative --}}
            <div class="sm:col-span-2 lg:col-span-8 border border-white/[0.06] bg-[#0d0d0e] p-8 md:p-10">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-8">Service Narrative</p>
                <div class="prose prose-invert prose-sm max-w-none
                            prose-p:text-white/50 prose-p:leading-relaxed prose-p:font-light prose-p:text-sm prose-p:mb-4
                            prose-strong:text-orange-400
                            prose-headings:text-white prose-headings:font-black prose-headings:tracking-tight prose-headings:uppercase prose-headings:text-sm prose-headings:mt-8 prose-headings:mb-3
                            prose-blockquote:border-l-orange-500 prose-blockquote:text-white/40 prose-blockquote:not-italic
                            prose-a:text-orange-400 prose-a:no-underline hover:prose-a:text-orange-300">
                    {!! $service->content ?? $service->description !!}
                </div>
            </div>

            {{-- [8] Why choose / quote card --}}
            <div class="lg:col-span-4 border border-white/[0.06] bg-[#0d0d0e] p-8 flex flex-col justify-between">
                <div>
                    <div class="text-orange-500/20 text-5xl font-black leading-none mb-4"
                        style="font-family:Georgia,serif;">"</div>
                    <p class="text-sm text-white/40 leading-relaxed font-light italic">
                        Let's discuss how this tailored capability can transform your digital footprint and drive measurable outcomes.
                    </p>
                </div>
                <div class="mt-8 pt-6 border-t border-white/[0.05]">
                    <div class="flex items-center gap-3 mb-1">
                        <div class="w-5 h-px bg-orange-500"></div>
                        <span class="text-[8px] font-bold uppercase tracking-[0.3em] text-white/30">Reva Adhitya</span>
                    </div>
                    <span class="text-[8px] font-mono text-orange-400/40 tracking-widest">Creative Director</span>
                </div>
            </div>

            {{-- [9] Process steps --}}
            <div class="sm:col-span-2 lg:col-span-12 border border-white/[0.06] bg-[#0d0d0e] p-8 md:p-10">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-8">Process</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach ([
                        ['01', 'Discovery', 'Understanding your goals, audience, and technical requirements.'],
                        ['02', 'Strategy', 'Crafting a tailored roadmap aligned to your business outcomes.'],
                        ['03', 'Execution', 'Precision-built delivery with iterative review checkpoints.'],
                        ['04', 'Launch', 'Deployment, QA, and post-launch monitoring and support.'],
                    ] as [$num, $title, $desc])
                        <div class="group/p border border-white/[0.06] bg-[#111] p-6 hover:border-orange-500/30 transition-colors duration-300">
                            <p class="font-mono text-[9px] text-orange-500/50 mb-4">{{ $num }}</p>
                            <p class="text-sm font-black text-white/70 group-hover/p:text-white transition-colors mb-2"
                                style="font-family:'Bebas Neue',sans-serif; font-size:1.1rem;">{{ strtoupper($title) }}</p>
                            <p class="text-[11px] text-white/30 leading-relaxed font-light">{{ $desc }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- Footer --}}
    <footer class="relative min-h-[65vh] flex flex-col items-center justify-center bg-white text-black
                   rounded-t-[50px] md:rounded-t-[100px] px-6 text-center overflow-hidden">
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] select-none pointer-events-none">
            <span class="text-[28vw] font-black tracking-tighter uppercase leading-none">Forge</span>
        </div>
        <div class="relative z-10">
            <p class="text-[9px] font-black uppercase tracking-[0.6em] mb-8 opacity-30">Ready to initiate?</p>
            <h2 class="text-5xl md:text-[8vw] font-black tracking-[-0.04em] leading-[0.9] mb-12"
                style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                Ready to make<br/><span class="text-orange-500">an Impact?</span>
            </h2>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="{{ route('home') }}#contact"
                    class="group relative inline-flex items-center gap-4 px-12 py-5 bg-black text-white overflow-hidden
                           hover:scale-105 active:scale-95 transition-transform duration-200">
                    <span class="relative z-10 text-[9px] font-black uppercase tracking-[0.35em]">Start Project Now</span>
                    <span class="relative z-10 text-sm">→</span>
                    <div class="absolute inset-0 bg-orange-500 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                </a>
                <a href="{{ route('home') }}#works"
                    class="text-[9px] font-black uppercase tracking-[0.4em] relative group overflow-hidden py-2">
                    <span class="block group-hover:-translate-y-full transition-transform duration-500">Explore Portfolio</span>
                    <span class="absolute top-full left-0 block group-hover:-translate-y-full transition-transform duration-500 text-orange-500">Explore Portfolio</span>
                </a>
            </div>
        </div>
        <div class="absolute bottom-8 opacity-20">
            <span class="text-[9px] font-bold tracking-[0.5em] uppercase">Jakarta / Indonesia</span>
        </div>
    </footer>

    <style>
        h1,h2,h3,h4{text-rendering:optimizeLegibility;-webkit-font-smoothing:antialiased;}
        ::-webkit-scrollbar{width:4px;}
        ::-webkit-scrollbar-track{background:#070708;}
        ::-webkit-scrollbar-thumb{background:#1a1a1c;}
        ::-webkit-scrollbar-thumb:hover{background:#f97316;}
        .prose strong{color:#fb923c !important;}
        .prose blockquote p{color:rgba(255,255,255,0.4) !important;}
    </style>

</div>