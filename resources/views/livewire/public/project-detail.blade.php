<div class="min-h-screen bg-[#070708] text-[#e5e5e5] antialiased selection:bg-white selection:text-black">

    @section('meta_title', $project->title . ' | Reva Adhitya')
    @section('meta_description', Str::limit(strip_tags($project->description), 160))
    @section('meta_keywords', 'Project, ' . $project->category . ', ' . $project->title . ', Reva Adhitya')
    @php
        $displayImage = $project->cover_image ?? $project->image;
    @endphp
    @if ($displayImage)
        @section('meta_image', asset('storage/' . $displayImage))
    @endif

    {{-- 1. Minimalist Back Button --}}
    <div class="fixed bottom-8 left-6 md:left-12 z-[100]">
        <button type="button" x-on:click="window.history.back()"
            class="group flex items-center gap-4 bg-transparent focus:outline-none">
            <div class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all duration-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path>
                </svg>
            </div>
        </button>
    </div>

    {{-- 2. Massive Editorial Hero --}}
    <header class="relative pt-40 pb-20 px-6 md:px-12 max-w-[1440px] mx-auto overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end">
            <div class="lg:col-span-8">
                <div class="flex items-center gap-4 mb-8">
                    <span class="font-mono text-xs text-orange-500 tracking-tighter">// PROJECT_{{ sprintf('%03d', $project->id) }}</span>
                    <div class="h-[1px] w-12 bg-white/20"></div>
                </div>
                <h1 class="text-[12vw] md:text-[9vw] font-black tracking-[calc(-0.06em)] leading-[0.85] text-white uppercase italic">
                    {{ $project->title }}<span class="text-orange-500">.</span>
                </h1>
            </div>
            <div class="lg:col-span-4">
                <p class="text-xl text-white/40 leading-relaxed font-light mb-8">
                    {{ Str::limit(strip_tags($project->description), 180) }}
                </p>
            </div>
        </div>

        {{-- Cinematic Main Image --}}
        <div class="mt-20 relative aspect-video md:aspect-[21/9] overflow-hidden rounded-sm border border-white/5">
            @if ($displayImage)
                <img id="hero-image" src="{{ asset('storage/' . $displayImage) }}"
                    class="w-full h-full object-cover grayscale brightness-75 transition-all duration-700">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-[#070708] via-transparent to-transparent"></div>
        </div>
    </header>

    {{-- 3. Specs Table (Metadata Bar) --}}
    <section class="relative z-10 border-y border-white/10">
        <div class="max-w-[1440px] mx-auto grid grid-cols-2 md:grid-cols-4 divide-x divide-white/10">
            <div class="p-8 md:p-12">
                <p class="text-[10px] uppercase tracking-[0.3em] text-white/30 mb-4">Field / Sector</p>
                <p class="text-lg font-bold uppercase tracking-tighter">{{ $project->category ?? 'Digital Architecture' }}</p>
            </div>
            <div class="p-8 md:p-12">
                <p class="text-[10px] uppercase tracking-[0.3em] text-white/30 mb-4">Involvement</p>
                <p class="text-lg font-bold uppercase tracking-tighter">{{ $project->role ?? 'Lead Developer' }}</p>
            </div>
            <div class="p-8 md:p-12">
                <p class="text-[10px] uppercase tracking-[0.3em] text-white/30 mb-4">Timeline</p>
                <p class="text-lg font-mono tracking-tighter">{{ $project->year ?? '2026' }}</p>
            </div>
            <div class="p-8 md:p-12 group cursor-pointer">
                @if ($project->link)
                    <a href="{{ $project->link }}" target="_blank" class="block">
                        <p class="text-orange-500 uppercase tracking-[0.3em] text-[10px] mb-4 group-hover:text-white transition-colors">Live Access</p>
                        <p class="text-lg font-bold uppercase tracking-tighter flex items-center gap-2 group-hover:gap-4 transition-all">
                            Visit Site <span>↗</span>
                        </p>
                    </a>
                @else
                    <p class="text-[10px] uppercase tracking-[0.3em] text-white/30 mb-4">Client</p>
                    <p class="text-lg font-bold uppercase tracking-tighter">{{ $project->client ?? 'Proprietary' }}</p>
                @endif
            </div>
        </div>
    </section>

    {{-- 4. Main Narrative Area --}}
    <main class="max-w-[1440px] mx-auto px-6 md:px-12 py-32">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">

            {{-- The Story --}}
            <div class="lg:col-span-7">
                <span class="inline-block px-4 py-1 rounded-full border border-orange-500/30 text-orange-500 text-[10px] font-black uppercase tracking-widest mb-12">
                    Case Narrative
                </span>
                <div class="prose prose-invert prose-2xl max-w-none 
                            prose-p:text-white/50 prose-p:leading-[1.6] prose-p:font-light
                            prose-headings:text-white prose-headings:font-black prose-headings:tracking-[calc(-0.04em)] prose-headings:uppercase
                            prose-strong:text-white prose-strong:font-bold
                            prose-blockquote:border-l-orange-500 prose-blockquote:bg-white/5 prose-blockquote:py-2 prose-blockquote:px-8">
                    {!! $project->content ?? $project->description !!}
                </div>
            </div>

            {{-- Specifications Sidebar --}}
            <div class="lg:col-span-5">
                <div class="sticky top-20">
                    <div class="p-12 bg-white/[0.02] border border-white/5 rounded-sm">
                        <h3 class="text-xs font-black uppercase tracking-[0.5em] text-white mb-12 pb-4 border-b border-white/10">Technical Scope</h3>
                        <ul class="space-y-8">
                            @foreach (['Art Direction', 'UI/UX Design', 'Full-stack Development', 'Motion & Interaction'] as $item)
                                <li class="flex items-center justify-between group">
                                    <span class="text-sm font-bold uppercase tracking-widest text-white/40 group-hover:text-white transition-colors">{{ $item }}</span>
                                    <div class="h-[1px] flex-grow mx-4 bg-white/5 group-hover:bg-orange-500/50 transition-colors"></div>
                                    <span class="font-mono text-[10px] text-orange-500 opacity-0 group-hover:opacity-100 transition-opacity">COMPLETED</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-20 pt-12 border-t border-white/5">
                            <p class="text-white/30 text-sm font-light italic leading-relaxed mb-8">
                                "This project represents a synthesis of technical performance and aesthetic intent, pushing the boundaries of modern web standards."
                            </p>
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-[1px] bg-orange-500"></div>
                                <span class="font-black text-[10px] uppercase tracking-[0.3em] text-white/80">Reva Adhitya — 2026</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 5. Staggered Media Gallery --}}
        @if ($project->media && $project->media->count() > 0)
            <div class="mt-40">
                <div class="mb-24 flex items-baseline gap-6">
                    <h3 class="text-7xl md:text-9xl font-black tracking-tighter uppercase opacity-10">Archive</h3>
                    <p class="text-orange-500 font-mono text-xs tracking-widest uppercase">Visual Evidence / Documentation</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach ($project->media as $index => $media)
                        <div class="relative overflow-hidden group aspect-[4/5] bg-zinc-900 border border-white/5">
                            
                            @if ($media->file_type === 'video')
                                <video src="{{ asset('storage/' . $media->file_path) }}" 
                                    controls
                                    class="w-full h-full object-cover grayscale-50 group-hover:grayscale-0 transition-all duration-1000">
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $media->file_path) }}"
                                    class="w-full h-full object-cover grayscale-[50%] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-[2s]">
                            @endif
                
                            {{-- Caption Overlay --}}
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                                <span class="bg-white text-black text-[9px] font-black font-mono px-3 py-1.5 uppercase tracking-[0.2em]">
                                    {{ $media->caption ?? 'VIEW_REF_' . sprintf('%02d', $index + 1) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    {{-- 6. High-Contrast Footer CTA --}}
    <footer class="py-40 bg-white text-black rounded-t-[100px] text-center px-6 overflow-hidden relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[30vw] font-black text-black/[0.03] select-none pointer-events-none uppercase tracking-tighter">
            Next
        </div>
        
        <div class="relative z-10">
            <p class="text-[10px] font-black uppercase tracking-[0.5em] mb-12 text-black/40">Ready to initiate?</p>
            <h2 class="text-6xl md:text-[8vw] font-black tracking-[calc(-0.06em)] leading-[0.9] mb-16 uppercase italic">
                Start a<br/>New Story.
            </h2>
            <a href="{{ route('home') }}#contact"
                class="group relative inline-flex items-center gap-6 px-16 py-8 bg-black text-white rounded-sm overflow-hidden transition-all hover:pr-20">
                <span class="text-xs font-black uppercase tracking-[0.4em] relative z-10">Begin Consultation</span>
                <span class="text-2xl relative z-10">→</span>
                <div class="absolute inset-0 bg-orange-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
            </a>
        </div>
    </footer>
</div>

<script>
    window.addEventListener('scroll', () => {
        const heroImg = document.getElementById('hero-image');
        if (heroImg) {
            const scroll = window.scrollY;
            heroImg.style.transform = `scale(${1 + scroll * 0.0002}) translateY(${scroll * 0.1}px)`;
            heroImg.style.filter = `grayscale(${Math.min(1, scroll / 500)}) brightness(${0.75 - (scroll / 2000)})`;
        }
    });
</script>