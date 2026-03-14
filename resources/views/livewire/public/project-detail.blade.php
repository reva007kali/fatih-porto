<div class="min-h-screen bg-[#070708] text-[#e5e5e5] antialiased selection:bg-orange-500 selection:text-white">

    @section('meta_title', $project->title . ' | Reva Adhitya')
    @section('meta_description', Str::limit(strip_tags($project->description), 160))
    @section('meta_keywords', 'Project, ' . $project->category . ', ' . $project->title . ', Reva Adhitya')
    @php $displayImage = $project->cover_image ?? $project->image; @endphp
    @if ($displayImage)
        @section('meta_image', asset('storage/' . $displayImage))
    @endif

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
                Project_{{ sprintf('%03d', $project->id) }}
            </span>
            <div class="h-px w-10 bg-white/10"></div>
            <span class="text-[9px] uppercase tracking-[0.3em] text-white/20">{{ $project->category ?? 'Development' }}</span>
        </div>
        <h1 class="text-[clamp(3rem,9vw,8rem)] font-black tracking-[-0.04em] leading-[0.85] uppercase"
            style="font-family:'Bebas Neue','Arial Black',sans-serif;">
            {{ $project->title }}<span class="text-orange-500">.</span>
        </h1>
    </header>

    {{-- ══════════════════════
         BENTO GRID
    ══════════════════════ --}}
    <div class="max-w-[1400px] mx-auto px-5 md:px-10 pb-32">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">

            {{-- [1] Hero image — wide --}}
            <div class="sm:col-span-2 lg:col-span-8 border border-white/[0.06] bg-[#0d0d0e] overflow-hidden group relative">
                <div class="aspect-video overflow-hidden">
                    @if ($displayImage)
                        <img src="{{ asset('storage/' . $displayImage) }}"
                            class="w-full h-full object-cover scale-105 group-hover:scale-100 transition-transform duration-[1.5s]">
                    @else
                        <div class="w-full h-full bg-[#111] flex items-center justify-center">
                            <span class="text-6xl font-black text-white/5"
                                style="font-family:'Bebas Neue',sans-serif;">{{ substr($project->title,0,1) }}</span>
                        </div>
                    @endif
                </div>
                {{-- Orange bottom sweep --}}
                <div class="absolute bottom-0 left-0 h-px w-0 bg-gradient-to-r from-orange-600 to-amber-400 group-hover:w-full transition-all duration-700"></div>
            </div>

            {{-- [2] Description card --}}
            <div class="lg:col-span-4 border border-white/[0.06] bg-[#0d0d0e] p-8 flex flex-col justify-between">
                <div>
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-orange-400/60 mb-4">Overview</p>
                    <p class="text-sm text-white/50 leading-relaxed font-light">
                        {{ Str::limit(strip_tags($project->description), 220) }}
                    </p>
                </div>
                @if ($project->link)
                    <a href="{{ $project->link }}" target="_blank"
                        class="mt-8 inline-flex items-center gap-2 text-[9px] font-bold uppercase tracking-[0.3em]
                               text-orange-400 hover:text-white transition-colors duration-200 group/link">
                        <span>Visit Live Site</span>
                        <svg class="w-3 h-3 group-hover/link:translate-x-0.5 group-hover/link:-translate-y-0.5 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                        </svg>
                    </a>
                @endif
            </div>

            {{-- [3] Category --}}
            <div class="lg:col-span-3 border border-white/[0.06] bg-[#0d0d0e] p-8 flex flex-col justify-between">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20">Field</p>
                <div>
                    <p class="text-[2.5rem] font-black leading-none text-white/5 mb-1"
                        style="font-family:'Bebas Neue',sans-serif;">CAT</p>
                    <p class="text-lg font-black uppercase tracking-tight text-white"
                        style="font-family:'Bebas Neue',sans-serif;">{{ $project->category ?? 'Digital' }}</p>
                </div>
            </div>

            {{-- [4] Year --}}
            <div class="lg:col-span-2 border border-white/[0.06] bg-[#0d0d0e] p-8 flex flex-col justify-between">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20">Year</p>
                <p class="text-4xl font-black font-mono text-white/80"
                    style="font-family:'Bebas Neue',sans-serif;">{{ $project->year ?? '2026' }}</p>
            </div>

            {{-- [5] Role --}}
            <div class="lg:col-span-3 border border-white/[0.06] bg-[#0d0d0e] p-8 flex flex-col justify-between">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20">Role</p>
                <p class="text-lg font-black uppercase tracking-tight text-white leading-tight"
                    style="font-family:'Bebas Neue',sans-serif;">{{ $project->role ?? 'Lead Developer' }}</p>
            </div>

            {{-- [6] Live CTA --}}
            <div class="lg:col-span-4 border border-orange-500/20 bg-orange-500/[0.04] p-8 flex flex-col justify-between group/cta">
                <div class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                </div>
                <div>
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-orange-400/60 mb-2">Status</p>
                    <p class="text-3xl font-black text-white leading-tight mb-5"
                        style="font-family:'Bebas Neue',sans-serif;">Live &<br>Deployed</p>
                    @if ($project->link)
                        <a href="{{ $project->link }}" target="_blank"
                            class="inline-flex items-center justify-center w-full py-3 bg-orange-500 text-white
                                   text-[9px] font-bold uppercase tracking-[0.3em]
                                   hover:bg-orange-400 active:scale-[0.98] transition-all duration-200">
                            Open Project ↗
                        </a>
                    @endif
                </div>
            </div>

            {{-- [7] Case narrative --}}
            <div class="sm:col-span-2 lg:col-span-8 border border-white/[0.06] bg-[#0d0d0e] p-8 md:p-10">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-8">Case Narrative</p>
                <div class="prose prose-invert prose-sm max-w-none
                            prose-p:text-white/50 prose-p:leading-relaxed prose-p:font-light prose-p:text-sm prose-p:mb-4
                            prose-strong:text-orange-400
                            prose-headings:text-white prose-headings:font-black prose-headings:tracking-tight prose-headings:uppercase prose-headings:text-base
                            prose-blockquote:border-l-orange-500 prose-blockquote:text-white/40
                            prose-a:text-orange-400 prose-a:no-underline hover:prose-a:text-orange-300">
                    {!! $project->content ?? $project->description !!}
                </div>
            </div>

            {{-- [8] Technical scope sidebar --}}
            <div class="lg:col-span-4 border border-white/[0.06] bg-[#0d0d0e] p-8">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-8">Technical Scope</p>
                <div class="divide-y divide-white/[0.05]">
                    @foreach (['Art Direction', 'UI / UX Design', 'Full-stack Dev', 'Motion & Interaction'] as $item)
                        <div class="group/sc flex items-center justify-between py-4">
                            <span class="text-xs font-bold text-white/40 group-hover/sc:text-white transition-colors duration-200">{{ $item }}</span>
                            <div class="w-1.5 h-1.5 rounded-full bg-orange-500/30 group-hover/sc:bg-orange-500 transition-colors duration-200"></div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8 pt-6 border-t border-white/[0.05]">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-5 h-px bg-orange-500"></div>
                        <span class="text-[8px] font-bold uppercase tracking-[0.3em] text-white/30">Reva Adhitya</span>
                    </div>
                    <p class="text-xs text-white/25 leading-relaxed font-light italic">
                        "A synthesis of technical performance and aesthetic intent."
                    </p>
                </div>
            </div>

            {{-- [9] Media gallery --}}
            @if ($project->media && $project->media->count() > 0)
                {{-- Gallery header --}}
                <div class="sm:col-span-2 lg:col-span-12 flex items-center gap-5 pt-4 pb-1">
                    <div class="w-1.5 h-1.5 rounded-full bg-orange-500"></div>
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/30">Visual Documentation</p>
                    <div class="flex-1 h-px bg-white/[0.05]"></div>
                    <span class="font-mono text-[9px] text-orange-400/50">{{ $project->media->count() }} assets</span>
                </div>

                @foreach ($project->media as $index => $media)
                    @php
                        $mediaSpans = [
                            0 => 'lg:col-span-7',
                            1 => 'lg:col-span-5',
                            2 => 'lg:col-span-4',
                            3 => 'lg:col-span-4',
                            4 => 'lg:col-span-4',
                        ];
                        $mediaAspects = [
                            0 => 'aspect-[16/9]',
                            1 => 'aspect-[4/3]',
                            2 => 'aspect-[4/3]',
                            3 => 'aspect-[4/3]',
                            4 => 'aspect-[4/3]',
                        ];
                        $span   = $mediaSpans[$index % count($mediaSpans)] ?? 'lg:col-span-4';
                        $aspect = $mediaAspects[$index % count($mediaAspects)] ?? 'aspect-[4/3]';
                    @endphp
                    <div class="sm:col-span-1 {{ $span }} border border-white/[0.06] bg-[#0d0d0e] overflow-hidden group relative">
                        <div class="{{ $aspect }} overflow-hidden">
                            @if ($media->file_type === 'video')
                                <video src="{{ asset('storage/' . $media->file_path) }}"
                                    controls
                                    class="w-full h-full object-cover"></video>
                            @else
                                <img src="{{ asset('storage/' . $media->file_path) }}"
                                    class="w-full h-full object-cover scale-105 group-hover:scale-100 transition-transform duration-[1.5s]">
                            @endif
                        </div>
                        {{-- Caption --}}
                        <div class="absolute bottom-0 left-0 right-0 px-4 py-3 bg-gradient-to-t from-black/70 to-transparent
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-400 flex items-center justify-between">
                            <span class="text-[8px] font-mono font-bold uppercase tracking-[0.2em] text-white/60">
                                {{ $media->caption ?? 'REF_' . sprintf('%02d', $index + 1) }}
                            </span>
                            <span class="text-[8px] font-mono text-orange-400/60">{{ sprintf('%02d', $index + 1) }}</span>
                        </div>
                        <div class="absolute bottom-0 left-0 h-px w-0 bg-gradient-to-r from-orange-600 to-amber-400 group-hover:w-full transition-all duration-700"></div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>

    {{-- Footer --}}
    <footer class="relative min-h-[65vh] flex flex-col items-center justify-center bg-white text-black
                   rounded-t-[50px] md:rounded-t-[100px] px-6 text-center overflow-hidden">
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] select-none pointer-events-none">
            <span class="text-[30vw] font-black tracking-tighter uppercase">Next</span>
        </div>
        <div class="relative z-10">
            <p class="text-[9px] font-black uppercase tracking-[0.6em] mb-8 opacity-30">Ready to initiate?</p>
            <h2 class="text-5xl md:text-[8vw] font-black tracking-[-0.04em] leading-[0.9] mb-12"
                style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                Start a<br/><span class="text-orange-500">New Story.</span>
            </h2>
            <a href="{{ route('home') }}#contact"
                class="group relative inline-flex items-center gap-4 px-12 py-5 bg-black text-white overflow-hidden
                       hover:scale-105 active:scale-95 transition-transform duration-200">
                <span class="relative z-10 text-[9px] font-black uppercase tracking-[0.35em]">Begin Consultation</span>
                <span class="relative z-10 text-sm">→</span>
                <div class="absolute inset-0 bg-orange-500 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
            </a>
        </div>
        <div class="absolute bottom-8 opacity-20">
            <span class="text-[9px] font-bold tracking-[0.5em] uppercase">Jakarta / Indonesia</span>
        </div>
    </footer>

</div>