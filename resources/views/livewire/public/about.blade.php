<div class="min-h-screen bg-[#0b0b0d] text-white antialiased selection:bg-orange-500 selection:text-white">

    @section('meta_title', 'About Me | Reva Adhitya')
    @section('meta_description', Str::limit(strip_tags($about->description), 160))
    @section('meta_keywords', 'About, Biography, Reva Adhitya, Designer, Developer')
    @if($about->image)
        @section('meta_image', asset('storage/' . $about->image))
    @endif

    {{-- 1. Floating Navigation --}}
    <div class="fixed bottom-8 left-6 md:left-12 z-[100]">
        <a href="{{ route('home') }}"
            class="group flex items-center justify-center w-14 h-14 rounded-full bg-black/40 backdrop-blur-xl border border-white/10 hover:border-orange-500/50 transition-all duration-500 hover:scale-110 shadow-2xl">
            <svg class="w-6 h-6 text-orange-500 group-hover:-translate-x-1 transition-transform" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
    </div>

    {{-- 2. Massive Background Text --}}
    <div
        class="absolute top-20 left-1/2 -translate-x-1/2 text-[30vw] font-black text-white/[0.01] select-none pointer-events-none leading-none z-0">
        WHO
    </div>

    <main class="relative z-10 max-w-7xl mx-auto px-6 md:px-12 pt-32 pb-32">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start">

            {{-- 3. Left Side: Visuals --}}
            {{-- Changed 'sticky top-32' to 'lg:sticky lg:top-32' --}}
            <div class="lg:col-span-5 lg:sticky lg:top-32">
                <div class="relative group">
                    {{-- Animated background glows --}}
                    <div
                        class="absolute -inset-10 bg-orange-600/20 rounded-full blur-[100px] opacity-50 group-hover:opacity-100 transition-opacity duration-1000">
                    </div>

                    {{-- Image Frame --}}
                    <div
                        class="relative aspect-[3/4] rounded-[40px] md:rounded-[60px] overflow-hidden border border-white/10 bg-zinc-900 shadow-2xl">
                        @if ($about->image)
                            <img src="{{ asset('storage/' . $about->image) }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                        @endif

                        {{-- Subtle gradient wash --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent">
                        </div>
                    </div>

                    {{-- Floating Status Badge --}}
                    <div
                        class="absolute -bottom-6 -right-6 bg-orange-600 p-8 rounded-[40px] shadow-2xl shadow-orange-900/40 hidden md:block">
                        <div class="text-black font-black">
                            <p class="text-4xl leading-none">ID</p>
                            <p class="text-[10px] uppercase tracking-widest mt-1 opacity-60">Verified</p>
                        </div>
                    </div>
                </div>

                {{-- Social Quick Links --}}
                <div class="mt-16 flex items-center gap-8 justify-center lg:justify-start">
                    @foreach (['LinkedIn', 'Twitter', 'GitHub'] as $social)
                        <a href="#"
                            class="text-[10px] font-black uppercase tracking-[0.3em] text-white/30 hover:text-orange-500 transition-colors">{{ $social }}</a>
                    @endforeach
                </div>
                
                {{-- Location Display (New) --}}
                @if($about->location)
                    <div class="mt-8 flex items-center gap-3 justify-center lg:justify-start text-white/50">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-sm font-medium tracking-widest uppercase">{{ $about->location }}</span>
                    </div>
                @endif
            </div>

            {{-- 4. Right Side: The Story --}}
            <div class="lg:col-span-7">
                {{-- Header Area --}}
                <div class="mb-16">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-12 h-[2px] bg-orange-500"></span>
                        <span class="text-orange-500 text-xs font-black uppercase tracking-[0.4em]">The Identity</span>
                    </div>

                    <h1
                        class="text-6xl md:text-6xl lg:text-7xl font-black tracking-tighter leading-[0.85] text-white mb-10">
                        {{ $about->title ?? 'About' }}<span class="text-orange-500">.</span>
                    </h1>

                    <p
                        class="text-2xl md:text-3xl text-white/80 font-medium leading-relaxed italic border-l-4 border-orange-500 pl-8 mb-12">
                        {{-- First paragraph highlight --}}
                        "{{ $about->description ?? "Design is not just what it looks like; it's how it works and feels." }}"
                    </p>
                </div>

                {{-- Main Biography Content --}}
                <div
                    class="prose prose-invert prose-lg max-w-none text-white/50 leading-relaxed
                            prose-headings:text-white prose-headings:font-black prose-headings:tracking-tighter
                            prose-strong:text-white prose-strong:font-black
                            prose-a:text-orange-500 prose-p:mb-8">
                    {!! $about->content !!}
                </div>

                {{-- Skills Section --}}
                @if($skills->count() > 0)
                    <div class="mt-20 pt-12 border-t border-white/5">
                        <h3 class="text-2xl font-bold text-white mb-8">Skills & Expertise</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-y-8 gap-x-4">
                            @foreach ($skills as $skill)
                                <div>
                                    <h4 class="text-orange-500 font-black text-[10px] uppercase tracking-[0.3em] mb-2">
                                        {{ $skill->category }}</h4>
                                    <p class="text-white/80 text-lg font-bold">{{ $skill->name }}</p>
                                    <div class="w-full bg-white/10 h-1 mt-2 rounded-full overflow-hidden">
                                        <div class="bg-orange-500 h-full" style="width: {{ $skill->proficiency }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Experience Section --}}
                @if($work_experiences->count() > 0)
                    <div class="mt-20 pt-12 border-t border-white/5">
                        <h3 class="text-2xl font-bold text-white mb-8">Experience</h3>
                        <div class="space-y-12">
                            @foreach($work_experiences as $work)
                                <div class="relative pl-8 border-l border-white/10">
                                    <span class="absolute -left-[5px] top-2 w-2.5 h-2.5 rounded-full bg-orange-500"></span>
                                    <h4 class="text-xl font-bold text-white">{{ $work->role }}</h4>
                                    <p class="text-orange-500 text-sm font-bold uppercase tracking-widest mb-2">{{ $work->company }}</p>
                                    <p class="text-white/40 text-xs mb-4">{{ $work->period }}</p>
                                    <p class="text-white/60 leading-relaxed">{{ $work->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Education Section --}}
                @if($educations->count() > 0)
                    <div class="mt-20 pt-12 border-t border-white/5">
                        <h3 class="text-2xl font-bold text-white mb-8">Education</h3>
                        <div class="space-y-12">
                             @foreach($educations as $edu)
                                <div class="relative pl-8 border-l border-white/10">
                                    <span class="absolute -left-[5px] top-2 w-2.5 h-2.5 rounded-full bg-zinc-800 border border-white/20"></span>
                                    <h4 class="text-xl font-bold text-white">{{ $edu->institution }}</h4>
                                    <p class="text-orange-500 text-sm font-bold uppercase tracking-widest mb-2">{{ $edu->degree }}</p>
                                    <p class="text-white/40 text-xs mb-4">{{ $edu->period }}</p>
                                    <p class="text-white/60 leading-relaxed">{{ $edu->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Certifications & Achievements --}}
                @if($certifications->count() > 0 || $achievements->count() > 0)
                    <div class="mt-20 pt-12 border-t border-white/5 grid grid-cols-1 md:grid-cols-2 gap-12">
                        @if($certifications->count() > 0)
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-8">Certifications</h3>
                                <ul class="space-y-6">
                                    @foreach($certifications as $cert)
                                        <li class="flex items-start gap-4">
                                            <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-orange-500 flex-shrink-0"></div>
                                            <div>
                                                <h5 class="text-white font-bold leading-tight">{{ $cert->name }}</h5>
                                                <p class="text-white/40 text-sm mt-1">{{ $cert->issuer }} • {{ $cert->date }}</p>
                                                @if($cert->link)
                                                    <a href="{{ $cert->link }}" target="_blank" class="text-orange-500 text-xs font-bold uppercase tracking-widest mt-2 inline-block hover:underline">View Credential</a>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($achievements->count() > 0)
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-8">Achievements</h3>
                                <ul class="space-y-6">
                                    @foreach($achievements as $ach)
                                        <li class="flex items-start gap-4">
                                             <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-orange-500 flex-shrink-0"></div>
                                            <div>
                                                <h5 class="text-white font-bold leading-tight">{{ $ach->title }}</h5>
                                                <p class="text-white/40 text-sm mt-1">{{ $ach->date }}</p>
                                                <p class="text-white/60 text-sm mt-2 leading-relaxed">{{ $ach->description }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </main>

    {{-- 5. Footer Transition --}}
    <footer class="py-32 bg-white text-black rounded-t-[60px] md:rounded-t-[100px] overflow-hidden relative">
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none">
            <span class="text-[20vw] font-black">COLLABORATE</span>
        </div>

        <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
            <h2 class="text-5xl md:text-8xl font-black tracking-tighter mb-12">Let's work <br /> together.</h2>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-8">
                <a href="{{ route('home') }}#contact"
                    class="px-12 py-6 rounded-full bg-black text-white font-black uppercase tracking-widest text-sm hover:bg-orange-600 transition-all shadow-2xl">
                    {{ $about->button_text ?? 'Get in Touch' }}
                </a>
                <a href="{{ $about->button_link ?? route('works') }}"
                    class="text-sm font-black uppercase tracking-[0.2em] border-b-2 border-black/10 hover:border-black transition-all pb-1">
                    See my works
                </a>
            </div>
        </div>
    </footer>

</div>
