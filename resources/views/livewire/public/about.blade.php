<div class="min-h-screen bg-[#050507] text-white antialiased overflow-x-hidden" style="font-family: -apple-system, 'SF Pro Display', 'Helvetica Neue', sans-serif;">

    @section('meta_title', 'About Me | Sofyan Abdul Fatih')
    @section('meta_description', Str::limit(strip_tags($about?->description ?? ''), 160))
    @section('meta_keywords', 'About, Biography, Sofyan Abdul Fatih, Designer, Video Editor')
    @if ($about?->image)
        @section('meta_image', asset('storage/' . $about->image))
    @endif

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes auroraFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -20px) scale(1.04); }
            66% { transform: translate(-20px, 10px) scale(0.97); }
        }
        @keyframes auroraFloat2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-30px, 20px) scale(1.06); }
            66% { transform: translate(20px, -15px) scale(0.96); }
        }
        @keyframes barFill {
            from { width: 0%; }
            to { width: var(--target-width); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.94); }
            to { opacity: 1; transform: scale(1); }
        }

        .aurora-bg {
            position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden;
        }
        .aurora-blob {
            position: absolute; border-radius: 50%; filter: blur(100px); pointer-events: none;
        }

        .reveal {
            opacity: 0; transform: translateY(28px);
            transition: opacity 0.9s cubic-bezier(0.16,1,0.3,1), transform 0.9s cubic-bezier(0.16,1,0.3,1);
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

        .skill-bar-fill {
            animation: barFill 1.2s cubic-bezier(0.16,1,0.3,1) forwards;
            animation-play-state: paused;
        }
        .skill-bar-fill.animate { animation-play-state: running; }

        .timeline-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: linear-gradient(135deg, #67e8f9, #818cf8);
            flex-shrink: 0; margin-top: 6px;
            box-shadow: 0 0 10px rgba(103,232,249,0.4);
        }
        .timeline-line {
            width: 1px; flex: 1; margin-top: 8px;
            background: linear-gradient(to bottom, rgba(103,232,249,0.2), transparent);
        }

        .portrait-container {
            position: relative; overflow: hidden;
            border-radius: 28px;
            border: 1px solid rgba(255,255,255,0.07);
        }
        .portrait-container::after {
            content: '';
            position: absolute; inset: 0; border-radius: 28px;
            background: linear-gradient(to bottom, transparent 50%, rgba(5,5,7,0.7) 100%);
        }

        .cert-item, .achievement-item {
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
        }
        .cert-item:hover, .achievement-item:hover {
            background: rgba(255,255,255,0.025);
        }

        .back-btn {
            position: fixed; bottom: 40px; left: 40px; z-index: 100;
            width: 52px; height: 52px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(16px);
            transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
        }
        .back-btn:hover {
            background: linear-gradient(135deg, rgba(103,232,249,0.2), rgba(129,140,248,0.2));
            border-color: rgba(103,232,249,0.3);
            transform: scale(1.08);
            box-shadow: 0 8px 32px rgba(103,232,249,0.15);
        }

        .section-title {
            font-family: 'Bebas Neue', 'Arial Black', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900; line-height: 0.9; letter-spacing: -0.03em;
        }

        /* Footer CTA */
        .footer-cta {
            background: linear-gradient(135deg, rgba(103,232,249,0.08), rgba(129,140,248,0.06));
            border: 1px solid rgba(103,232,249,0.12);
            border-radius: 28px;
            backdrop-filter: blur(20px);
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
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.6); font-weight: 700; font-size: 11px;
            letter-spacing: 0.15em; text-transform: uppercase;
            transition: all 0.3s ease;
        }
        .btn-outline-sm:hover { border-color: rgba(255,255,255,0.35); color: white; background: rgba(255,255,255,0.05); }

        ::-webkit-scrollbar { width: 3px; }
        ::-webkit-scrollbar-track { background: #050507; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 9999px; }
        ::selection { background: #67e8f9; color: #050507; }
    </style>

    {{-- Aurora background --}}
    <div class="aurora-bg">
        <div class="aurora-blob w-[700px] h-[700px] opacity-[0.09]" style="background: radial-gradient(circle, #67e8f9, transparent 70%); top: -200px; right: -100px; animation: auroraFloat 14s ease-in-out infinite;"></div>
        <div class="aurora-blob w-[500px] h-[500px] opacity-[0.07]" style="background: radial-gradient(circle, #818cf8, transparent 70%); top: 40%; left: -150px; animation: auroraFloat2 18s ease-in-out infinite;"></div>
        <div class="aurora-blob w-[400px] h-[400px] opacity-[0.06]" style="background: radial-gradient(circle, #34d399, transparent 70%); bottom: 20%; right: 10%; animation: auroraFloat 22s ease-in-out infinite reverse;"></div>
    </div>

    {{-- Back button --}}
    <a href="{{ route('home') }}" class="back-btn">
        <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    </a>

    <main class="relative z-10">

        {{-- ══════════════════════════════════
             HERO — Centered portrait + name
        ══════════════════════════════════ --}}
        <section class="min-h-[90vh] flex flex-col items-center justify-center text-center px-6 pt-20 pb-0">

            {{-- Portrait --}}
            <div class="reveal mb-10" style="animation: scaleIn 1s 0.2s cubic-bezier(0.16,1,0.3,1) both;">
                <div class="portrait-container w-[160px] h-[160px] md:w-[200px] md:h-[200px] mx-auto">
                    @if ($about?->image)
                        <img src="{{ asset('storage/' . $about->image) }}"
                            class="w-full h-full object-cover object-top">
                    @else
                        <div class="w-full h-full flex items-center justify-center" style="background: rgba(103,232,249,0.06);">
                            <span class="text-5xl font-black text-white/10" style="font-family:'Bebas Neue',sans-serif;">SAF</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Label --}}
            <div class="reveal mb-6" style="--delay:100ms">
                <div class="pill-label">The Creative Identity</div>
            </div>

            {{-- Name --}}
            <div class="reveal mb-5 overflow-hidden" style="--delay:180ms">
                <h1 class="section-title text-white" style="font-size: clamp(3.5rem, 10vw, 8rem);">
                    {{ $about?->title ?? 'Sofyan Abdul' }}<span class="gradient-text">.</span>
                </h1>
            </div>

            {{-- Role tags --}}
            <div class="reveal flex items-center justify-center gap-3 flex-wrap mb-8" style="--delay:260ms">
                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-[0.25em] text-white/40" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">Designer</span>
                <span class="w-1 h-1 rounded-full bg-white/15"></span>
                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-[0.25em] text-white/40" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">Motion Artist</span>
                <span class="w-1 h-1 rounded-full bg-white/15"></span>
                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-[0.25em] text-white/40" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">Video Editor</span>
            </div>

            {{-- Availability badge --}}
            <div class="reveal" style="--delay:340ms">
                <div class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full" style="background: rgba(52,211,153,0.07); border: 1px solid rgba(52,211,153,0.18);">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-400"></span>
                    </span>
                    <span class="text-[9px] font-bold uppercase tracking-[0.3em] text-emerald-400">{{ $about?->availability_status ?? 'Available for Work' }}</span>
                </div>
            </div>

            {{-- Scroll cue --}}
            <div class="mt-20 mb-0 flex flex-col items-center gap-3 opacity-20">
                <span class="text-[8px] font-bold tracking-[0.4em] uppercase text-white">Scroll</span>
                <div class="w-px h-12 overflow-hidden bg-white/20">
                    <div class="w-full h-1/2 bg-white" style="animation: scrollLine 2s ease-in-out infinite;"></div>
                </div>
            </div>
        </section>

        <style>
            @keyframes scrollLine {
                0% { transform: translateY(-100%); }
                50% { transform: translateY(200%); }
                100% { transform: translateY(200%); }
            }
        </style>


        {{-- ══════════════════════════════════
             BIO
        ══════════════════════════════════ --}}
        <section class="py-28 md:py-36 px-6">
            <div class="max-w-[680px] mx-auto">

                <div class="reveal text-center mb-16">
                    <div class="pill-label mx-auto mb-8 w-fit">Biography</div>
                    <h2 class="section-title text-white mb-0">
                        WHO <span class="gradient-text">I AM.</span>
                    </h2>
                </div>

                <div class="divider mb-14 reveal"></div>

                {{-- Motto / pull quote --}}
                <div class="reveal text-center mb-14" style="--delay:80ms">
                    <p class="text-2xl md:text-3xl text-white/80 font-light leading-snug tracking-tight italic" style="font-family: Georgia, serif;">
                        "{{ $about?->motto ?? ($about?->description ?? 'Design is logic made visible.') }}"
                    </p>
                </div>

                <div class="divider mb-14 reveal" style="--delay:100ms"></div>

                {{-- Bio content --}}
                <div class="reveal" style="--delay:120ms">
                    <div class="prose prose-invert max-w-none text-center
                            prose-p:text-white/45 prose-p:leading-[1.85] prose-p:text-[17px] prose-p:mb-6
                            prose-strong:text-white/80 prose-strong:font-semibold
                            prose-headings:text-white prose-headings:font-black prose-headings:tracking-tight prose-headings:text-center
                            prose-a:text-cyan-400 prose-a:no-underline hover:prose-a:text-cyan-300">
                        {!! $about?->content ?? '<p>' . ($about?->description ?? '') . '</p>' !!}
                    </div>
                </div>

                {{-- Two stats inline --}}
                <div class="reveal mt-16 flex items-center justify-center gap-12" style="--delay:160ms">
                    <div class="text-center">
                        <p class="text-5xl font-black gradient-text mb-1" style="font-family:'Bebas Neue',sans-serif;">40+</p>
                        <p class="text-[9px] font-bold uppercase tracking-[0.3em] text-white/25">Projects</p>
                    </div>
                    <div class="w-px h-12 bg-white/10"></div>
                    <div class="text-center">
                        <p class="text-5xl font-black gradient-text mb-1" style="font-family:'Bebas Neue',sans-serif;">5+</p>
                        <p class="text-[9px] font-bold uppercase tracking-[0.3em] text-white/25">Years</p>
                    </div>
                    <div class="w-px h-12 bg-white/10"></div>
                    <div class="text-center">
                        <p class="text-5xl font-black gradient-text mb-1" style="font-family:'Bebas Neue',sans-serif;">100%</p>
                        <p class="text-[9px] font-bold uppercase tracking-[0.3em] text-white/25">Satisfaction</p>
                    </div>
                </div>

                {{-- CTA row --}}
                <div class="reveal mt-14 flex items-center justify-center gap-4 flex-wrap" style="--delay:200ms">
                    @if ($about?->cv_file)
                    <a href="{{ asset('storage/' . $about->cv_file) }}" download class="btn-primary-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                        </svg>
                        Download CV
                    </a>
                    @endif
                    <a href="{{ route('home') }}#contact" class="btn-outline-sm">
                        Get in Touch
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>


        {{-- ══════════════════════════════════
             SKILLS
        ══════════════════════════════════ --}}
        @if ($skills->count() > 0)
        <section class="py-28 md:py-36 px-6" style="background: rgba(103,232,249,0.02);">
            <div class="max-w-[680px] mx-auto">

                <div class="reveal text-center mb-16">
                    <div class="pill-label mx-auto mb-8 w-fit">Expertise</div>
                    <h2 class="section-title text-white">
                        SKILL <span class="gradient-text">STACK.</span>
                    </h2>
                </div>

                <div class="divider mb-14 reveal"></div>

                {{-- Top skill highlight --}}
                @php $topSkill = $skills->sortByDesc('proficiency')->first(); @endphp
                @if ($topSkill)
                <div class="reveal text-center mb-14" style="--delay:60ms">
                    <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/20 mb-3">Top Proficiency</p>
                    <p class="text-8xl font-black gradient-text leading-none mb-2" style="font-family:'Bebas Neue',sans-serif;">{{ $topSkill->proficiency }}<span class="text-5xl">%</span></p>
                    <p class="text-xl font-bold text-white/60">{{ $topSkill->name }}</p>
                    <p class="text-[9px] uppercase tracking-widest text-white/25 mt-1">{{ $topSkill->category }}</p>
                </div>
                <div class="divider mb-14 reveal" style="--delay:80ms"></div>
                @endif

                {{-- Skills list --}}
                <div class="space-y-0 skill-list">
                    @foreach ($skills as $i => $skill)
                    <div class="reveal group py-6 border-b border-white/[0.05] last:border-0" style="--delay:{{ $i * 50 }}ms">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-4">
                                <span class="text-[8px] font-bold uppercase tracking-[0.35em] text-white/20 w-20">{{ $skill->category }}</span>
                                <span class="text-base font-semibold text-white/60 group-hover:text-white transition-colors duration-300">{{ $skill->name }}</span>
                            </div>
                            <span class="text-xs font-mono text-white/25 group-hover:text-cyan-400 transition-colors duration-300">{{ $skill->proficiency }}%</span>
                        </div>
                        {{-- Bar --}}
                        <div class="w-full h-px bg-white/[0.06] overflow-hidden rounded-full">
                            <div class="h-full rounded-full skill-bar-fill"
                                style="--target-width: {{ $skill->proficiency }}%; background: linear-gradient(90deg, #67e8f9, #818cf8, #a78bfa);"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif


        {{-- ══════════════════════════════════
             EXPERIENCE
        ══════════════════════════════════ --}}
        @if ($work_experiences->count() > 0)
        <section class="py-28 md:py-36 px-6">
            <div class="max-w-[680px] mx-auto">

                <div class="reveal text-center mb-16">
                    <div class="pill-label mx-auto mb-8 w-fit">Career</div>
                    <h2 class="section-title text-white">
                        WORK <span class="gradient-text">HISTORY.</span>
                    </h2>
                </div>

                <div class="divider mb-16 reveal"></div>

                <div class="space-y-0">
                    @foreach ($work_experiences as $i => $item)
                    <div class="reveal flex gap-7 pb-14 last:pb-0" style="--delay:{{ $i * 70 }}ms">
                        <div class="flex flex-col items-center pt-1">
                            <div class="timeline-dot"></div>
                            @if (!$loop->last)
                            <div class="timeline-line"></div>
                            @endif
                        </div>
                        <div class="flex-1 pb-2">
                            <p class="text-[9px] font-mono text-cyan-400/50 mb-2 tracking-[0.1em]">{{ $item->period }}</p>
                            <h4 class="text-xl font-black text-white/80 tracking-tight mb-1" style="font-family:'Bebas Neue',sans-serif;">{{ $item->role }}</h4>
                            <p class="text-[9px] font-bold uppercase tracking-[0.35em] text-white/25 mb-4">{{ $item->company }}</p>
                            <p class="text-sm text-white/40 leading-[1.8] font-light">{{ $item->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif


        {{-- ══════════════════════════════════
             EDUCATION
        ══════════════════════════════════ --}}
        @if ($educations->count() > 0)
        <section class="py-28 md:py-36 px-6" style="background: rgba(103,232,249,0.02);">
            <div class="max-w-[680px] mx-auto">

                <div class="reveal text-center mb-16">
                    <div class="pill-label mx-auto mb-8 w-fit">Academic</div>
                    <h2 class="section-title text-white">
                        EDUCATION<span class="gradient-text">.</span>
                    </h2>
                </div>

                <div class="divider mb-16 reveal"></div>

                <div class="space-y-0">
                    @foreach ($educations as $i => $item)
                    <div class="reveal flex gap-7 pb-14 last:pb-0" style="--delay:{{ $i * 70 }}ms">
                        <div class="flex flex-col items-center pt-1">
                            <div class="w-2 h-2 rounded-full border-2 flex-shrink-0 mt-1" style="border-color: rgba(103,232,249,0.5); margin-top: 5px;"></div>
                            @if (!$loop->last)
                            <div class="timeline-line"></div>
                            @endif
                        </div>
                        <div class="flex-1 pb-2">
                            <p class="text-[9px] font-mono text-cyan-400/50 mb-2 tracking-[0.1em]">{{ $item->period }}</p>
                            <h4 class="text-xl font-black text-white/80 tracking-tight mb-1" style="font-family:'Bebas Neue',sans-serif;">{{ $item->institution }}</h4>
                            <p class="text-[9px] font-bold uppercase tracking-[0.35em] text-white/25 mb-4">{{ $item->degree }}</p>
                            <p class="text-sm text-white/40 leading-[1.8] font-light">{{ $item->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif


        {{-- ══════════════════════════════════
             CERTIFICATIONS
        ══════════════════════════════════ --}}
        @if ($certifications->count() > 0)
        <section class="py-28 md:py-36 px-6">
            <div class="max-w-[680px] mx-auto">

                <div class="reveal text-center mb-16">
                    <div class="pill-label mx-auto mb-8 w-fit">Credentials</div>
                    <h2 class="section-title text-white">
                        CERTIFI<span class="gradient-text">CATIONS.</span>
                    </h2>
                </div>

                <div class="divider mb-10 reveal"></div>

                <div class="space-y-0">
                    @foreach ($certifications as $i => $item)
                    <div class="reveal cert-item flex items-center justify-between gap-6 py-7 border-b border-white/[0.05] last:border-0 rounded-xl px-4 -mx-4" style="--delay:{{ $i * 50 }}ms">
                        <div class="flex items-start gap-5">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5" style="background: rgba(103,232,249,0.07); border: 1px solid rgba(103,232,249,0.12);">
                                <svg class="w-4 h-4" style="color: rgba(103,232,249,0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-base font-semibold text-white/75 mb-1">{{ $item->name }}</h4>
                                <p class="text-xs text-white/30">{{ $item->issuer }}
                                    @if ($item->date)<span class="mx-2 text-white/15">·</span>{{ $item->date }}@endif
                                </p>
                            </div>
                        </div>
                        @if ($item->link)
                        <a href="{{ $item->link }}" target="_blank" class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110" style="background: rgba(103,232,249,0.07); border: 1px solid rgba(103,232,249,0.12);">
                            <svg class="w-3.5 h-3.5" style="color: rgba(103,232,249,0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif


        {{-- ══════════════════════════════════
             ACHIEVEMENTS
        ══════════════════════════════════ --}}
        @if ($achievements->count() > 0)
        <section class="py-28 md:py-36 px-6" style="background: rgba(103,232,249,0.02);">
            <div class="max-w-[680px] mx-auto">

                <div class="reveal text-center mb-16">
                    <div class="pill-label mx-auto mb-8 w-fit">Recognition</div>
                    <h2 class="section-title text-white">
                        ACHIEVE<span class="gradient-text">MENTS.</span>
                    </h2>
                </div>

                <div class="divider mb-10 reveal"></div>

                <div class="space-y-0">
                    @foreach ($achievements as $i => $item)
                    <div class="reveal achievement-item py-8 px-5 -mx-5 border-b border-white/[0.05] last:border-0 rounded-xl" style="--delay:{{ $i * 60 }}ms">
                        <div class="flex items-start gap-5">
                            <div class="text-[9px] font-mono text-white/20 w-20 flex-shrink-0 pt-1 tracking-[0.1em]">{{ $item->date }}</div>
                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-white/75 mb-2 tracking-tight">{{ $item->title }}</h4>
                                <p class="text-sm text-white/35 leading-[1.8] font-light">{{ $item->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif


        {{-- ══════════════════════════════════
             SOCIALS
        ══════════════════════════════════ --}}
        <section class="py-28 md:py-36 px-6">
            <div class="max-w-[680px] mx-auto">

                <div class="reveal text-center mb-16">
                    <div class="pill-label mx-auto mb-8 w-fit">Connect</div>
                    <h2 class="section-title text-white">
                        FIND ME <span class="gradient-text">ONLINE.</span>
                    </h2>
                </div>

                <div class="divider mb-10 reveal"></div>

                <div class="space-y-0">
                    @if ($about?->cv_file)
                    <div class="reveal py-6 border-b border-white/[0.05]">
                        <a href="{{ asset('storage/' . $about->cv_file) }}" target="_blank"
                            class="group flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(103,232,249,0.07); border: 1px solid rgba(103,232,249,0.12);">
                                    <svg class="w-4 h-4" style="color: rgba(103,232,249,0.6);" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M7.5 12l4.5 4.5m0 0l4.5-4.5m-4.5 4.5v-9"/>
                                    </svg>
                                </div>
                                <span class="text-base font-semibold text-white/60 group-hover:text-white transition-colors duration-300">Download CV</span>
                            </div>
                            <svg class="w-4 h-4 text-white/20 group-hover:text-cyan-400 group-hover:translate-y-0.5 transition-all duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                            </svg>
                        </a>
                    </div>
                    @endif

                    @foreach ($social_links as $i => $link)
                    <div class="reveal py-6 border-b border-white/[0.05] last:border-0" style="--delay:{{ $i * 50 }}ms">
                        <a href="{{ $link->url }}" target="_blank" class="group flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07);">
                                    @if ($link->icon)
                                        <img src="{{ asset('storage/' . $link->icon) }}" class="w-4 h-4 object-contain opacity-30 group-hover:opacity-70 transition-opacity">
                                    @else
                                        <span class="text-xs font-bold text-white/25">{{ substr($link->platform, 0, 2) }}</span>
                                    @endif
                                </div>
                                <span class="text-base font-semibold text-white/50 group-hover:text-white transition-colors duration-300">{{ $link->platform }}</span>
                            </div>
                            <svg class="w-4 h-4 text-white/15 group-hover:text-cyan-400 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>


        {{-- ══════════════════════════════════
             FOOTER CTA
        ══════════════════════════════════ --}}
        <section class="py-20 md:py-28 px-6">
            <div class="max-w-[680px] mx-auto">
                <div class="reveal footer-cta p-12 md:p-16 text-center">
                    <p class="text-[9px] font-bold uppercase tracking-[0.5em] text-white/25 mb-6">Ready to Begin?</p>
                    <h2 class="section-title text-white mb-6" style="font-size: clamp(2.5rem, 7vw, 5rem);">
                        LET'S BUILD<br><span class="gradient-text">THE FUTURE.</span>
                    </h2>
                    <p class="text-sm text-white/35 font-light leading-relaxed max-w-xs mx-auto mb-10">
                        I'm open to new projects, collaborations, and exciting creative challenges.
                    </p>
                    <div class="flex items-center justify-center gap-4 flex-wrap">
                        <a href="{{ route('home') }}#contact" class="btn-primary-sm">
                            Start a Project
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('works') }}" class="btn-outline-sm">
                            View My Work
                        </a>
                    </div>
                </div>

                {{-- Location / copyright --}}
                <div class="reveal mt-12 text-center" style="--delay:100ms">
                    <p class="text-[9px] font-bold uppercase tracking-[0.5em] text-white/15">Jakarta · Indonesia · © 2026</p>
                </div>
            </div>
        </section>

    </main>


    <script>
        // Scroll reveal
        const revealEls = document.querySelectorAll('.reveal');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -20px 0px' });
        revealEls.forEach(el => io.observe(el));

        // Skill bar animation
        const skillBars = document.querySelectorAll('.skill-bar-fill');
        const barIo = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('animate'); barIo.unobserve(e.target); }
            });
        }, { threshold: 0.5 });
        skillBars.forEach(el => barIo.observe(el));
    </script>
</div>