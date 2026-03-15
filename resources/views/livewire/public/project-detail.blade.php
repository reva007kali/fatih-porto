<div class="min-h-screen bg-[#050507] text-white antialiased overflow-x-hidden" style="font-family: -apple-system, 'SF Pro Display', 'Helvetica Neue', sans-serif;">

    @section('meta_title', $project->title . ' | Sofyan Abdul Fatih')
    @section('meta_description', Str::limit(strip_tags($project->description), 160))
    @section('meta_keywords', 'Project, ' . $project->category . ', ' . $project->title . ', Sofyan Abdul Fatih')
    @php $displayImage = $project->cover_image ?? $project->image; @endphp
    @if ($displayImage)
        @section('meta_image', asset('storage/' . $displayImage))
    @endif

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.97); }
            to { opacity: 1; transform: scale(1); }
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

        /* Back button */
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

        /* Hero image */
        .hero-image-wrap {
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.07);
            background: #0d0d12;
        }
        .hero-image-wrap img,
        .hero-image-wrap video {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 1.5s ease;
        }
        .hero-image-wrap:hover img,
        .hero-image-wrap:hover video { transform: scale(1.03); }

        /* Meta pills row */
        .meta-chip {
            display: inline-flex; flex-direction: column; gap: 4px;
            padding: 16px 20px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 16px;
            flex: 1; min-width: 100px;
            transition: all 0.3s ease;
        }
        .meta-chip:hover {
            border-color: rgba(103,232,249,0.18);
            background: rgba(103,232,249,0.04);
        }

        /* Scope list */
        .scope-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            transition: all 0.25s ease;
        }
        .scope-item:last-child { border-bottom: none; }
        .scope-item:hover .scope-dot {
            background: #67e8f9;
            box-shadow: 0 0 8px rgba(103,232,249,0.5);
        }
        .scope-item:hover .scope-label { color: rgba(255,255,255,0.8); }

        /* Gallery */
        .gallery-item {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.06);
            background: #0d0d12;
            position: relative;
            transition: all 0.4s ease;
        }
        .gallery-item:hover {
            border-color: rgba(103,232,249,0.2);
            transform: translateY(-3px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        }
        .gallery-item img,
        .gallery-item video {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 1.5s ease;
        }
        .gallery-item:hover img { transform: scale(1.04); }

        .gallery-caption {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 12px 14px;
            background: linear-gradient(to top, rgba(5,5,7,0.8), transparent);
            border-radius: 0 0 18px 18px;
            opacity: 0; transition: opacity 0.3s ease;
            display: flex; align-items: center; justify-content: space-between;
        }
        .gallery-item:hover .gallery-caption { opacity: 1; }

        /* CTA buttons */
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

        /* Footer aurora */
        .footer-aurora {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, #030b1a 0%, #0a0520 50%, #050507 100%);
        }

        ::-webkit-scrollbar { width: 3px; }
        ::-webkit-scrollbar-track { background: #050507; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 9999px; }
        ::selection { background: #67e8f9; color: #050507; }
    </style>

    {{-- Aurora fixed bg --}}
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="aurora-blob w-[700px] h-[700px] opacity-[0.08]" style="background: radial-gradient(circle, #67e8f9, transparent 70%); top: -150px; right: -100px; animation: auroraFloat 15s ease-in-out infinite;"></div>
        <div class="aurora-blob w-[500px] h-[500px] opacity-[0.06]" style="background: radial-gradient(circle, #818cf8, transparent 70%); top: 50%; left: -100px; animation: auroraFloat2 20s ease-in-out infinite;"></div>
        <div class="aurora-blob w-[400px] h-[400px] opacity-[0.05]" style="background: radial-gradient(circle, #34d399, transparent 70%); bottom: 20%; right: 5%; animation: auroraFloat 25s ease-in-out infinite reverse;"></div>
    </div>

    {{-- Back button --}}
    <button type="button" x-on:click="window.history.back()" class="back-btn">
        <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    <main class="relative z-10">

        {{-- ══════════════════════════════════
             HERO HEADER — Centered
        ══════════════════════════════════ --}}
        <header class="pt-36 pb-16 px-6 text-center">
            <div class="max-w-[760px] mx-auto">

                {{-- Breadcrumb row --}}
                <div class="flex items-center justify-center gap-3 mb-8"
                    style="animation: fadeUp 0.7s 0.1s ease both;">
                    <span class="font-mono text-[9px] text-white/20 tracking-[0.3em] uppercase">
                        Project_{{ sprintf('%03d', $project->id) }}
                    </span>
                    <span class="w-4 h-px bg-white/10"></span>
                    <span class="text-[9px] uppercase tracking-[0.3em] text-white/20">{{ $project->category ?? 'Development' }}</span>
                </div>

                {{-- Title --}}
                <h1 class="text-[clamp(3rem,9vw,7.5rem)] font-black tracking-[-0.04em] leading-[0.85] uppercase text-white mb-8"
                    style="font-family:'Bebas Neue','Arial Black',sans-serif; animation: fadeUp 0.9s 0.18s cubic-bezier(0.16,1,0.3,1) both;">
                    {{ $project->title }}<span class="gradient-text">.</span>
                </h1>

                {{-- Short description --}}
                <p class="text-base md:text-lg text-white/35 leading-relaxed font-light max-w-lg mx-auto mb-10"
                    style="animation: fadeUp 0.7s 0.3s ease both;">
                    {{ Str::limit(strip_tags($project->description), 160) }}
                </p>

                {{-- CTAs --}}
                <div class="flex items-center justify-center gap-3 flex-wrap" style="animation: fadeUp 0.7s 0.38s ease both;">
                    @if ($project->link)
                    <a href="{{ $project->link }}" target="_blank" class="btn-primary-sm">
                        Visit Live Site
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
                        </svg>
                    </a>
                    @endif
                    <a href="{{ route('works') }}" wire:navigate class="btn-outline-sm">
                        All Projects
                    </a>
                </div>
            </div>
        </header>


        {{-- ══════════════════════════════════
             HERO IMAGE — Full bleed centered
        ══════════════════════════════════ --}}
        <section class="px-6 mb-16" style="animation: scaleIn 1s 0.4s cubic-bezier(0.16,1,0.3,1) both;">
            <div class="max-w-[1100px] mx-auto">
                <div class="hero-image-wrap aspect-video">
                    @if ($displayImage)
                        @php
                            $heroUrl = Str::startsWith($displayImage, 'http') ? $displayImage : asset('storage/' . $displayImage);
                            $heroExt = strtolower(pathinfo($displayImage, PATHINFO_EXTENSION));
                            $heroIsVideo = in_array($heroExt, ['mp4','webm','ogg','mov','avi','mkv']);
                        @endphp
                        @if ($heroIsVideo)
                            <video src="{{ $heroUrl }}" muted loop autoplay playsinline></video>
                        @else
                            <img src="{{ $heroUrl }}" alt="{{ $project->title }}">
                        @endif
                    @else
                        <div class="w-full h-full flex items-center justify-center" style="background: rgba(103,232,249,0.04);">
                            <span class="text-[12rem] font-black text-white/[0.04]" style="font-family:'Bebas Neue',sans-serif;">{{ substr($project->title,0,1) }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </section>


        {{-- ══════════════════════════════════
             META CHIPS — Inline stats row
        ══════════════════════════════════ --}}
        <section class="px-6 mb-20">
            <div class="max-w-[760px] mx-auto">
                <div class="reveal flex flex-wrap gap-3">
                    <div class="meta-chip">
                        <span class="text-[8px] font-bold uppercase tracking-[0.35em] text-white/20">Category</span>
                        <span class="text-sm font-black text-white/80 uppercase" style="font-family:'Bebas Neue',sans-serif;">{{ $project->category ?? 'Digital' }}</span>
                    </div>
                    <div class="meta-chip">
                        <span class="text-[8px] font-bold uppercase tracking-[0.35em] text-white/20">Year</span>
                        <span class="text-sm font-black text-white/80 font-mono">{{ $project->year ?? '2026' }}</span>
                    </div>
                    <div class="meta-chip">
                        <span class="text-[8px] font-bold uppercase tracking-[0.35em] text-white/20">Role</span>
                        <span class="text-sm font-black text-white/80 uppercase" style="font-family:'Bebas Neue',sans-serif;">{{ $project->role ?? 'Lead Designer' }}</span>
                    </div>
                    <div class="meta-chip" style="background: rgba(52,211,153,0.06); border-color: rgba(52,211,153,0.15);">
                        <span class="text-[8px] font-bold uppercase tracking-[0.35em] text-white/20">Status</span>
                        <span class="text-sm font-black flex items-center gap-2" style="color: #34d399; font-family:'Bebas Neue',sans-serif;">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 inline-block" style="box-shadow: 0 0 6px rgba(52,211,153,0.6);"></span>
                            Live
                        </span>
                    </div>
                </div>
            </div>
        </section>


        {{-- ══════════════════════════════════
             CASE NARRATIVE
        ══════════════════════════════════ --}}
        <section class="py-20 px-6" style="background: rgba(103,232,249,0.015);">
            <div class="max-w-[680px] mx-auto">

                <div class="reveal text-center mb-14">
                    <div class="pill-label mx-auto mb-8 w-fit">Case Narrative</div>
                    <h2 class="text-[clamp(2rem,5vw,3.5rem)] font-black leading-[0.9] text-white"
                        style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                        THE <span class="gradient-text">STORY.</span>
                    </h2>
                </div>

                <div class="divider mb-12 reveal"></div>

                <div class="reveal" style="--delay:80ms">
                    <div class="prose prose-invert max-w-none
                                prose-p:text-white/45 prose-p:leading-[1.85] prose-p:text-[16px] prose-p:mb-6
                                prose-strong:text-white/75 prose-strong:font-semibold
                                prose-headings:text-white prose-headings:font-black prose-headings:tracking-tight prose-headings:uppercase prose-headings:mb-4
                                prose-blockquote:border-l-cyan-500/40 prose-blockquote:text-white/35 prose-blockquote:italic
                                prose-a:text-cyan-400 prose-a:no-underline hover:prose-a:text-cyan-300">
                        {!! $project->content ?? '<p>' . ($project->description ?? '') . '</p>' !!}
                    </div>
                </div>
            </div>
        </section>


        {{-- ══════════════════════════════════
             TECHNICAL SCOPE
        ══════════════════════════════════ --}}
        <section class="py-20 px-6">
            <div class="max-w-[680px] mx-auto">

                <div class="reveal text-center mb-14">
                    <div class="pill-label mx-auto mb-8 w-fit">Scope</div>
                    <h2 class="text-[clamp(2rem,5vw,3.5rem)] font-black leading-[0.9] text-white"
                        style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                        TECHNICAL <span class="gradient-text">SCOPE.</span>
                    </h2>
                </div>

                <div class="divider mb-10 reveal"></div>

                <div class="reveal" style="--delay:60ms">
                    @foreach (['Art Direction', 'UI / UX Design', 'Full-stack Dev', 'Motion & Interaction'] as $i => $item)
                    <div class="scope-item">
                        <div class="flex items-center gap-4">
                            <span class="text-[9px] font-mono text-white/20 w-6">{{ sprintf('%02d', $i + 1) }}</span>
                            <span class="scope-label text-sm font-semibold text-white/50 transition-colors duration-300">{{ $item }}</span>
                        </div>
                        <div class="scope-dot w-1.5 h-1.5 rounded-full transition-all duration-300" style="background: rgba(103,232,249,0.25);"></div>
                    </div>
                    @endforeach
                </div>

                {{-- Signature --}}
                <div class="reveal mt-10 pt-8 flex items-center gap-4" style="--delay:100ms; border-top: 1px solid rgba(255,255,255,0.04);">
                    <div class="w-px h-10 bg-gradient-to-b from-cyan-400/40 to-transparent"></div>
                    <div>
                        <p class="text-[8px] font-bold uppercase tracking-[0.35em] text-white/20 mb-1">Sofyan Abdul Fatih</p>
                        <p class="text-xs text-white/25 italic font-light">"A synthesis of technical performance and aesthetic intent."</p>
                    </div>
                </div>
            </div>
        </section>


        {{-- ══════════════════════════════════
             MEDIA GALLERY
        ══════════════════════════════════ --}}
        @if ($project->media && $project->media->count() > 0)
        <section class="py-20 px-6" style="background: rgba(103,232,249,0.015);">
            <div class="max-w-[1100px] mx-auto">

                <div class="reveal text-center mb-14">
                    <div class="pill-label mx-auto mb-8 w-fit">
                        Visual Documentation · {{ $project->media->count() }} assets
                    </div>
                    <h2 class="text-[clamp(2rem,5vw,3.5rem)] font-black leading-[0.9] text-white"
                        style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                        THE <span class="gradient-text">GALLERY.</span>
                    </h2>
                </div>

                <div class="divider mb-12 reveal"></div>

                {{-- Masonry-inspired grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($project->media as $index => $media)
                    @php
                        $isWide = $index === 0 || ($index % 5 === 0 && $index !== 0);
                        $aspects = ['aspect-[16/10]','aspect-[4/3]','aspect-[3/4]','aspect-[4/3]','aspect-[16/10]'];
                        $aspect = $aspects[$index % count($aspects)];
                    @endphp
                    <div class="reveal gallery-item {{ $isWide ? 'md:col-span-2' : '' }} {{ $aspect }}" style="--delay:{{ ($index % 6) * 60 }}ms">
                        @if ($media->file_type === 'video')
                            <video src="{{ asset('storage/' . $media->file_path) }}" controls class="w-full h-full object-cover"></video>
                        @else
                            <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->caption ?? 'Project image ' . ($index + 1) }}">
                        @endif
                        <div class="gallery-caption">
                            <span class="text-[8px] font-mono font-bold uppercase tracking-[0.2em] text-white/50">
                                {{ $media->caption ?? 'REF_' . sprintf('%02d', $index + 1) }}
                            </span>
                            <span class="text-[8px] font-mono" style="color: rgba(103,232,249,0.5);">{{ sprintf('%02d', $index + 1) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif


        {{-- ══════════════════════════════════
             FOOTER CTA
        ══════════════════════════════════ --}}
        <footer class="footer-aurora relative z-10 px-6 pt-32 pb-20">

            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="aurora-blob w-[600px] h-[600px] opacity-[0.12]" style="background: radial-gradient(circle, #67e8f9, transparent 60%); top: -100px; left: -100px; animation: auroraFloat 15s ease-in-out infinite;"></div>
                <div class="aurora-blob w-[500px] h-[500px] opacity-[0.10]" style="background: radial-gradient(circle, #818cf8, transparent 60%); bottom: -50px; right: -50px; animation: auroraFloat2 18s ease-in-out infinite;"></div>
            </div>

            {{-- Wave divider --}}
            <div class="absolute top-0 left-0 w-full overflow-hidden leading-none">
                <svg viewBox="0 0 1440 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-16 md:h-24">
                    <path d="M0,0 L1440,0 L1440,40 C1300,90 1150,100 1000,75 C850,50 700,20 550,50 C400,80 250,100 100,70 L0,50 Z" fill="#050507"/>
                </svg>
            </div>

            <div class="max-w-[680px] mx-auto text-center relative z-10">

                <div class="reveal pill-label mx-auto mb-8 w-fit">Ready to initiate?</div>

                <h2 class="reveal text-[clamp(2.5rem,8vw,6rem)] font-black leading-[0.88] text-white mb-6"
                    style="font-family:'Bebas Neue','Arial Black',sans-serif; --delay:60ms">
                    START A<br><span class="gradient-text">NEW STORY.</span>
                </h2>

                <p class="reveal text-sm text-white/35 font-light leading-relaxed max-w-xs mx-auto mb-12" style="--delay:120ms">
                    Have a project in mind? I'd love to hear about it and bring it to life.
                </p>

                <div class="reveal flex items-center justify-center gap-4 flex-wrap" style="--delay:180ms">
                    <a href="{{ route('home') }}#contact" class="btn-primary-sm">
                        Begin Consultation
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('works') }}" wire:navigate class="btn-outline-sm">
                        More Work
                    </a>
                </div>

                <div class="reveal mt-16 pt-8" style="--delay:220ms; border-top: 1px solid rgba(255,255,255,0.05);">
                    <p class="text-[9px] font-bold uppercase tracking-[0.5em] text-white/15">Jakarta · Indonesia · © 2026</p>
                </div>
            </div>
        </footer>

    </main>


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