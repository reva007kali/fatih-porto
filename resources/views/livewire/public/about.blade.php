<div class="min-h-screen bg-[#070708] text-[#e5e5e5] antialiased selection:bg-white selection:text-black font-sans overflow-x-hidden">

    @section('meta_title', 'About Me | Reva Adhitya')
    @section('meta_description', Str::limit(strip_tags($about->description), 160))
    @section('meta_keywords', 'About, Biography, Reva Adhitya, Designer, Developer')
    @if($about->image)
        @section('meta_image', asset('storage/' . $about->image))
    @endif

    {{-- 1. Custom Cursor Element (Placeholder for CSS/JS) --}}
    <div class="fixed top-0 left-0 w-8 h-8 border border-white/30 rounded-full pointer-events-none z-[999] mix-blend-difference transition-transform duration-300 ease-out hidden md:block" id="custom-cursor"></div>

    {{-- 2. Floating Navigation (Magnetic Style) --}}
    <div class="fixed bottom-10 left-10 z-[100]">
        <a href="{{ route('home') }}"
            class="group relative flex items-center justify-center w-16 h-16 rounded-full border border-white/10 bg-white/5 backdrop-blur-md hover:bg-white hover:border-white transition-all duration-700 hover:scale-110">
            <svg class="w-5 h-5 text-white group-hover:text-black transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
    </div>

    {{-- 3. Cinematic Hero Background --}}
    <div class="absolute top-0 left-0 w-full h-[100vh] pointer-events-none overflow-hidden z-0">
        <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[45vw] font-black text-white/[0.02] leading-none whitespace-nowrap tracking-tighter">
            ABOUT
        </span>
    </div>

    <main class="relative z-10 max-w-[1440px] mx-auto px-6 md:px-20 pt-48 pb-40">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-20">

            {{-- Left Side: The Visual Minimalist --}}
            <div class="lg:col-span-5 lg:sticky lg:top-40 h-fit">
                <div class="relative overflow-hidden group">
                    {{-- Reveal Overlay Effect --}}
                    <div class="absolute inset-0 bg-black/50 z-20 transition-transform duration-1000 ease-in-out group-hover:translate-y-full"></div>
                    
                    <div class="aspect-[4/5] overflow-hidden grayscale hover:grayscale-0 transition-all duration-1000 ease-in-out">
                        @if ($about->image)
                            <img src="{{ asset('storage/' . $about->image) }}"
                                class="w-full h-full object-cover scale-110 group-hover:scale-100 transition-transform duration-[2s]">
                        @endif
                    </div>
                </div>

                <div class="mt-12 space-y-4">
                    <div class="h-[1px] w-full bg-white/10 scale-x-0 origin-left transition-transform duration-1000 group-hover:scale-x-100"></div>
                    <div class="flex flex-wrap gap-x-8 gap-y-4 pt-4">
                        @foreach (['LinkedIn', 'Twitter', 'GitHub'] as $social)
                            <a href="#" class="text-[10px] font-bold uppercase tracking-widest text-white/40 hover:text-white transition-all relative group overflow-hidden">
                                <span class="block group-hover:-translate-y-full transition-transform duration-500">{{ $social }}</span>
                                <span class="absolute top-full left-0 block group-hover:-translate-y-full transition-transform duration-500 text-white">{{ $social }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right Side: The Editorial Narrative --}}
            <div class="lg:col-span-7">
                {{-- Split-Typo Header --}}
                <div class="mb-24">
                    <div class="flex items-center gap-4 mb-8 overflow-hidden">
                        <span class="text-[10px] font-bold uppercase tracking-[0.5em] text-white/30">The Creative Identity</span>
                        <div class="flex-grow h-[1px] bg-white/10"></div>
                    </div>

                    <h1 class="text-7xl md:text-8xl font-bebas lg:text-[120px] font-black tracking-tighter leading-[0.8] mb-12">
                        {{ $about->title ?? 'About' }}<span class="text-white/20">.</span>
                    </h1>

                    <div class="max-w-xl">
                        <p class="text-2xl md:text-3xl text-white/90 font-light leading-snug tracking-tight italic opacity-80 border-l border-white/20 pl-10 mb-16">
                            "{{ $about->description ?? "Design is logic made visible." }}"
                        </p>
                    </div>
                </div>

                {{-- Prose Content with Clean Typography --}}
                <div class="prose prose-invert max-w-none 
                            prose-p:text-xl prose-p:text-white/50 prose-p:leading-relaxed prose-p:mb-10
                            prose-strong:text-white prose-strong:font-bold
                            prose-headings:text-white prose-headings:font-black prose-headings:tracking-tighter prose-headings:uppercase
                            prose-a:text-white prose-a:underline prose-a:underline-offset-8 hover:prose-a:text-white/60">
                    {!! $about->content !!}
                </div>

                {{-- Skills Grid: Minimalist Rows --}}
                @if($skills->count() > 0)
                    <div class="mt-40">
                        <h3 class="text-xs font-bold text-white/30 uppercase tracking-[0.5em] mb-12">Expertise Stack</h3>
                        <div class="border-t border-white/10">
                            @foreach ($skills as $skill)
                                <div class="group flex items-center justify-between py-8 border-b border-white/10 hover:bg-white/5 transition-colors px-4">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-white/30 uppercase tracking-widest mb-1">{{ $skill->category }}</span>
                                        <span class="text-2xl font-bold tracking-tighter group-hover:pl-4 transition-all duration-500">{{ $skill->name }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm font-mono opacity-20 group-hover:opacity-100 transition-opacity">{{ $skill->proficiency }}%</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Timeline Sections (Work & Education) --}}
                @foreach([['Experiences', $work_experiences], ['Academic', $educations]] as [$label, $data])
                    @if($data->count() > 0)
                        <div class="mt-40">
                            <h3 class="text-xs font-bold text-white/30 uppercase tracking-[0.5em] mb-12">{{ $label }}</h3>
                            <div class="space-y-20">
                                @foreach($data as $item)
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 relative group">
                                        <div class="text-[10px] font-mono text-white/20 pt-2">{{ $item->period }}</div>
                                        <div class="md:col-span-3">
                                            <h4 class="text-3xl font-bold tracking-tighter mb-2 group-hover:text-white transition-colors">
                                                {{ $item->role ?? $item->institution }}
                                            </h4>
                                            <p class="text-white/40 uppercase tracking-widest text-[10px] font-black mb-6">
                                                {{ $item->company ?? $item->degree }}
                                            </p>
                                            <p class="text-white/50 leading-relaxed max-w-xl text-lg font-light">
                                                {{ $item->description }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </main>

    {{-- Cinematic Footer --}}
    <footer class="relative min-h-[80vh] flex flex-col items-center justify-center bg-white text-black rounded-t-[50px] md:rounded-t-[120px] px-6 text-center overflow-hidden">
        {{-- Background Kinetic Text --}}
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] select-none">
            <span class="text-[30vw] font-black tracking-tighter leading-none uppercase">Contact</span>
        </div>

        <div class="relative z-10">
            <p class="text-[10px] font-black uppercase tracking-[0.8em] mb-10 opacity-40 italic">Ready to begin?</p>
            <h2 class="text-6xl md:text-[10vw] font-black tracking-[calc(-0.05em)] leading-[0.9] mb-16">
                Let's build <br/> the future.
            </h2>
            
            <div class="flex flex-col md:flex-row items-center justify-center gap-12">
                <a href="{{ route('home') }}#contact"
                    class="group relative px-16 py-8 rounded-full bg-black text-white overflow-hidden transition-transform hover:scale-105 active:scale-95">
                    <span class="relative z-10 text-xs font-black uppercase tracking-widest">
                        {{ $about->button_text ?? 'Start Project' }}
                    </span>
                    <div class="absolute inset-0 bg-neutral-800 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                </a>
                
                <a href="{{ $about->button_link ?? route('works') }}"
                    class="text-xs font-black uppercase tracking-[0.4em] relative group overflow-hidden py-2">
                    <span class="block group-hover:-translate-y-full transition-transform duration-500">View Catalog</span>
                    <span class="absolute top-full left-0 block group-hover:-translate-y-full transition-transform duration-500 underline underline-offset-4">View Catalog</span>
                </a>
            </div>
        </div>

        <div class="absolute bottom-10 flex flex-col items-center opacity-20">
            <span class="text-[10px] font-bold tracking-[0.5em] uppercase">Jakarta / Indonesia</span>
        </div>
    </footer>

</div>