<div
    class="min-h-screen bg-[#070708] text-[#e5e5e5] antialiased selection:bg-orange-500 selection:text-white font-sans overflow-x-hidden">

    @section('meta_title', 'About Me | Reva Adhitya')
    @section('meta_description', Str::limit(strip_tags($about->description), 160))
    @section('meta_keywords', 'About, Biography, Reva Adhitya, Designer, Developer')
    @if ($about->image)
        @section('meta_image', asset('storage/' . $about->image))
    @endif


    {{-- Back Nav --}}
    <div class="fixed bottom-10 left-10 z-[100]">
        <a href="{{ route('home') }}"
            class="group relative flex items-center justify-center w-16 h-16 rounded-full border border-white/10 bg-white/5 backdrop-blur-md hover:bg-orange-500 hover:border-orange-500 transition-all duration-500 hover:scale-110">
            <svg class="w-5 h-5 text-white transition-colors duration-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </div>

    {{-- Hero BG watermark --}}
    <div class="absolute top-0 left-0 w-full h-screen pointer-events-none overflow-hidden z-0">
        <span
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[45vw] font-black text-white/[0.015] leading-none whitespace-nowrap tracking-tighter select-none">
            ABOUT
        </span>
    </div>

    <main class="relative z-10 max-w-[1400px] mx-auto px-5 md:px-10 pt-32 pb-40">

        {{-- ── Page header ── --}}
        <div class="mb-10">
            <div class="flex items-center gap-4 mb-5">
                <div class="w-1.5 h-1.5 rounded-full bg-orange-500"></div>
                <span class="text-[9px] font-bold uppercase tracking-[0.5em] text-white/30">The Creative Identity</span>
            </div>
            <h1 class="text-[clamp(4rem,12vw,9rem)] font-black tracking-[-0.04em] leading-[0.85]"
                style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                {{ $about->title ?? 'About' }}<span class="text-orange-500">.</span>
            </h1>
        </div>

        {{-- ══════════════════════════
             BENTO GRID
        ══════════════════════════ --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">

            {{-- [1] Portrait — tall left card --}}
            <div
                class="sm:col-span-1 lg:col-span-4 lg:row-span-2 border border-white/[0.06] bg-[#0d0d0e] overflow-hidden group relative">
                <div
                    class="absolute inset-0 bg-black/40 z-20 transition-transform duration-1000 group-hover:translate-y-full">
                </div>
                @if ($about->image)
                    <img src="{{ asset('storage/' . $about->image) }}"
                        class="w-full object-cover object-top grayscale group-hover:grayscale-0 scale-110 group-hover:scale-100 transition-all duration-[2s] aspect-[3/4]">
                @else
                    <div class="w-full aspect-[3/4] flex items-center justify-center bg-[#111]">
                        <span class="text-8xl font-black text-white/5"
                            style="font-family:'Bebas Neue',sans-serif;">RA</span>
                    </div>
                @endif
                {{-- Name overlay --}}
                <div class="absolute bottom-0 left-0 right-0 z-30 p-6 bg-gradient-to-t from-black/80 to-transparent">
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-orange-400/80 mb-1">Designer &
                        Developer</p>
                    <p class="text-xl font-black text-white tracking-tight"
                        style="font-family:'Bebas Neue',sans-serif;">Revaldy Adhitya</p>
                </div>
            </div>
            {{-- [2] Quote card --}}
            <div
                class="sm:col-span-1 lg:col-span-5 border border-white/[0.06] bg-[#0d0d0e] p-8 md:p-10 flex flex-col justify-between">
                <div class="text-orange-500/30 text-6xl font-black leading-none mb-4"
                    style="font-family:Georgia,serif;">"</div>
                <p class="text-xl md:text-2xl text-white/80 font-light leading-snug tracking-tight italic flex-1">
                    {{ $about->description ?? 'Design is logic made visible.' }}
                </p>
                <div class="mt-8 pt-6 border-t border-white/[0.06] flex items-center gap-3">
                    <div class="w-6 h-px bg-orange-500"></div>
                    <span class="text-[9px] font-bold uppercase tracking-[0.35em] text-white/30">Personal Mantra</span>
                </div>
            </div>

            {{-- [3] Status / availability chip --}}
            <div
                class="lg:col-span-3 border border-orange-500/20 bg-orange-500/[0.04] p-8 flex flex-col justify-between">
                <div class="relative flex h-2.5 w-2.5 mb-auto">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-orange-500"></span>
                </div>
                <div>
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-orange-400/60 mb-2">Current Status
                    </p>
                    <p class="text-2xl font-black text-white leading-tight"
                        style="font-family:'Bebas Neue',sans-serif;">Available<br>for Work</p>
                </div>
            </div>

            {{-- [4] Bio prose --}}
            <div class="lg:col-span-5 border border-white/[0.06] bg-[#0d0d0e] p-8 md:p-10">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-6">Biography</p>
                <div
                    class="prose prose-invert prose-sm max-w-none
                            prose-p:text-white/50 prose-p:leading-relaxed prose-p:text-base prose-p:mb-4
                            prose-strong:text-orange-400 prose-strong:font-bold
                            prose-headings:text-white prose-headings:font-black prose-headings:tracking-tighter
                            prose-a:text-orange-400 prose-a:no-underline hover:prose-a:text-orange-300">
                    {!! $about->content !!}
                </div>
            </div>

            {{-- [5] Socials card --}}
            <div class="lg:col-span-3 border border-white/[0.06] bg-[#0d0d0e] p-8 flex flex-col justify-between">
                <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-8">Connect</p>
                <div class="space-y-5">
                    @foreach (['LinkedIn', 'Twitter', 'GitHub'] as $social)
                        <a href="#"
                            class="group/s flex items-center justify-between border-b border-white/[0.06] pb-5 last:border-0 last:pb-0">
                            <span
                                class="text-sm font-bold text-white/50 group-hover/s:text-white transition-colors duration-300">{{ $social }}</span>
                            <svg class="w-3.5 h-3.5 text-white/20 group-hover/s:text-orange-500 group-hover/s:translate-x-0.5 group-hover/s:-translate-y-0.5 transition-all duration-200"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- [6] Skills grid --}}
            @if ($skills->count() > 0)
                <div class="sm:col-span-2 lg:col-span-8 border border-white/[0.06] bg-[#0d0d0e] p-8 md:p-10">
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-8">Expertise Stack</p>
                    <div class="divide-y divide-white/[0.05]">
                        @foreach ($skills as $skill)
                            <div
                                class="group/sk flex items-center justify-between py-5 hover:bg-white/[0.02] -mx-3 px-3 transition-colors">
                                <div class="flex items-center gap-6">
                                    <span
                                        class="text-[8px] font-bold uppercase tracking-[0.3em] text-orange-500/50 w-20 flex-shrink-0">{{ $skill->category }}</span>
                                    <span
                                        class="text-base font-bold text-white/60 group-hover/sk:text-white transition-colors duration-300">{{ $skill->name }}</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    {{-- Mini bar --}}
                                    <div class="hidden md:block w-24 h-px bg-white/10 overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-orange-600 to-amber-400 transition-all duration-700"
                                            style="width:{{ $skill->proficiency }}%"></div>
                                    </div>
                                    <span
                                        class="text-xs font-mono text-white/20 group-hover/sk:text-orange-400 transition-colors w-10 text-right">{{ $skill->proficiency }}%</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- [7] Top skill highlight --}}
                <div
                    class="lg:col-span-4 border border-white/[0.06] bg-gradient-to-br from-orange-600/10 to-amber-500/5 p-8 flex flex-col justify-between">
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-orange-400/60 mb-4">Top Skill</p>
                    @php $topSkill = $skills->sortByDesc('proficiency')->first(); @endphp
                    @if ($topSkill)
                        <div>
                            <div class="text-[4rem] font-black leading-none text-white/10 mb-2"
                                style="font-family:'Bebas Neue',sans-serif;">
                                {{ $topSkill->proficiency }}<span class="text-3xl">%</span>
                            </div>
                            <p class="text-2xl font-black text-white" style="font-family:'Bebas Neue',sans-serif;">
                                {{ $topSkill->name }}</p>
                            <p class="text-[9px] uppercase tracking-widest text-orange-400/60 mt-1">
                                {{ $topSkill->category }}</p>
                        </div>
                    @endif
                    <div class="mt-6 w-full h-px bg-white/10 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-orange-500 to-amber-400"
                            style="width:{{ $topSkill->proficiency ?? 0 }}%"></div>
                    </div>
                </div>
            @endif

            {{-- [8] Work Experience --}}
            @if ($work_experiences->count() > 0)
                <div class="sm:col-span-2 lg:col-span-6 border border-white/[0.06] bg-[#0d0d0e] p-8 md:p-10">
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-8">Experience</p>
                    <div class="space-y-8">
                        @foreach ($work_experiences as $item)
                            <div class="group/e grid grid-cols-[auto_1fr] gap-5">
                                <div class="flex flex-col items-center pt-1.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-orange-500 flex-shrink-0"></div>
                                    <div class="w-px flex-1 bg-white/[0.06] mt-2"></div>
                                </div>
                                <div class="pb-8 last:pb-0">
                                    <p class="text-[8px] font-mono text-orange-400/50 mb-1">{{ $item->period }}</p>
                                    <h4
                                        class="text-lg font-black text-white/80 group-hover/e:text-white tracking-tight transition-colors">
                                        {{ $item->role }}</h4>
                                    <p class="text-[9px] font-bold uppercase tracking-[0.3em] text-white/30 mb-3">
                                        {{ $item->company }}</p>
                                    <p class="text-sm text-white/40 leading-relaxed font-light">
                                        {{ $item->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- [9] Education --}}
            @if ($educations->count() > 0)
                <div class="sm:col-span-2 lg:col-span-6 border border-white/[0.06] bg-[#0d0d0e] p-8 md:p-10">
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-8">Academic</p>
                    <div class="space-y-8">
                        @foreach ($educations as $item)
                            <div class="group/ed grid grid-cols-[auto_1fr] gap-5">
                                <div class="flex flex-col items-center pt-1.5">
                                    <div class="w-1.5 h-1.5 rounded-full border border-orange-500 flex-shrink-0"></div>
                                    <div class="w-px flex-1 bg-white/[0.06] mt-2"></div>
                                </div>
                                <div class="pb-8 last:pb-0">
                                    <p class="text-[8px] font-mono text-orange-400/50 mb-1">{{ $item->period }}</p>
                                    <h4
                                        class="text-lg font-black text-white/80 group-hover/ed:text-white tracking-tight transition-colors">
                                        {{ $item->institution }}</h4>
                                    <p class="text-[9px] font-bold uppercase tracking-[0.3em] text-white/30 mb-3">
                                        {{ $item->degree }}</p>
                                    <p class="text-sm text-white/40 leading-relaxed font-light">
                                        {{ $item->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
        {{-- end bento --}}

    </main>

    {{-- Footer --}}
    <footer
        class="relative min-h-[80vh] flex flex-col items-center justify-center bg-white text-black rounded-t-[50px] md:rounded-t-[100px] px-6 text-center overflow-hidden">
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] select-none pointer-events-none">
            <span class="text-[30vw] font-black tracking-tighter leading-none uppercase">Contact</span>
        </div>
        <div class="relative z-10">
            <p class="text-[9px] font-black uppercase tracking-[0.8em] mb-8 opacity-30">Ready to begin?</p>
            <h2 class="text-5xl md:text-[9vw] font-black tracking-[-0.04em] leading-[0.9] mb-14"
                style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                Let's build<br><span class="text-orange-500">the future.</span>
            </h2>
            <div class="flex flex-col md:flex-row items-center justify-center gap-8">
                <a href="{{ route('home') }}#contact"
                    class="group relative px-14 py-6 bg-black text-white overflow-hidden transition-transform hover:scale-105 active:scale-95">
                    <span
                        class="relative z-10 text-[10px] font-black uppercase tracking-widest">{{ $about->button_text ?? 'Start Project' }}</span>
                    <div
                        class="absolute inset-0 bg-orange-500 translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                    </div>
                </a>
                <a href="{{ $about->button_link ?? route('works') }}"
                    class="text-[10px] font-black uppercase tracking-[0.4em] relative group overflow-hidden py-2">
                    <span class="block group-hover:-translate-y-full transition-transform duration-500">View
                        Catalog</span>
                    <span
                        class="absolute top-full left-0 block group-hover:-translate-y-full transition-transform duration-500 text-orange-500">View
                        Catalog</span>
                </a>
            </div>
        </div>
        <div class="absolute bottom-8 opacity-20">
            <span class="text-[9px] font-bold tracking-[0.5em] uppercase">Jakarta / Indonesia</span>
        </div>
    </footer>

</div>
