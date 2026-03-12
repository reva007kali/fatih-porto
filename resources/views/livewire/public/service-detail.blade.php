<div class="min-h-screen bg-[#070708] text-[#e5e5e5] antialiased selection:bg-white selection:text-black overflow-x-hidden">

    {{-- 1. Floating Back Button (Editorial Style) --}}
    <div class="fixed top-10 left-6 md:left-12 z-[100]">
        <button type="button" x-on:click="window.history.back()"
            class="group flex items-center gap-4 bg-transparent focus:outline-none"
            title="Go Back">
            
            <div class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all duration-500 hover:rotate-[-15deg]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path>
                </svg>
            </div>
            
            <span class="text-[10px] uppercase tracking-[0.4em] font-bold text-white/40 group-hover:text-white transition-colors">Return</span>
        </button>
    </div>

    {{-- 2. Massive Editorial Header (Hero) --}}
    <header class="relative min-h-[90vh] flex items-center max-w-[1440px] mx-auto px-6 md:px-12 py-32 overflow-hidden border-b border-white/10 z-10">
        {{-- Background Texture (Service Icon with semi-grayscale) --}}
        @if ($service->icon)
            <div class="absolute inset-0 pointer-events-none grayscale-[70%] opacity-[0.03] scale-110 group-hover:scale-100 transition-transform duration-[3s]">
                <img src="{{ asset('storage/' . $service->icon) }}"
                    class="w-full h-full object-cover">
            </div>
        @endif

        {{-- Gradient Overlay (Darker for contrast) --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[#070708] via-[#070708]/90 to-transparent"></div>

        <div class="relative w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end">
                <div class="lg:col-span-8">
                    <div class="flex items-center gap-4 mb-8">
                        <span class="font-mono text-xs text-orange-600 tracking-tighter">// CAPABILITY_{{ sprintf('%02d', $service->id) }}</span>
                        <div class="h-[1px] w-12 bg-white/20"></div>
                    </div>
                    <h1 class="text-[12vw] md:text-[10vw] font-black tracking-[calc(-0.06em)] leading-[0.8] text-white uppercase italic">
                        {{ $service->title }}<span class="text-white/20 hover:text-orange-600 transition-colors duration-1000">.</span>
                    </h1>
                </div>
                <div class="lg:col-span-4 pb-4">
                    <p class="text-2xl text-white/50 leading-snug font-light max-w-md">
                        {{ Str::limit(strip_tags($service->description), 180) }}
                    </p>
                </div>
            </div>
        </div>
    </header>

    {{-- 3. In-Depth Content Strategy Section --}}
    <main class="relative z-10 max-w-[1440px] mx-auto px-6 md:px-12 py-32 md:py-48">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start overflow-visible">

            {{-- Left Side: Deep Dive Content with Clean Typography --}}
            <div class="lg:col-span-7 prose-container overflow-visible">
                <div class="flex items-center gap-4 mb-16 overflow-hidden">
                    <span class="text-[10px] font-bold uppercase tracking-[0.5em] text-white/30 whitespace-nowrap">Service Narrative</span>
                    <div class="flex-grow h-[1px] bg-white/10"></div>
                </div>

                <div class="prose prose-invert prose-2xl max-w-none 
                            prose-p:text-white/50 prose-p:leading-[1.7] prose-p:font-light prose-p:mb-12
                            prose-headings:text-white prose-headings:font-black prose-headings:tracking-[calc(-0.04em)] prose-headings:uppercase prose-headings:mb-10 prose-headings:mt-20
                            prose-strong:text-white prose-strong:font-bold
                            prose-blockquote:border-l-orange-600 prose-blockquote:bg-white/5 prose-blockquote:py-4 prose-blockquote:px-10 prose-blockquote:font-normal
                            prose-a:text-white prose-a:underline prose-a:underline-offset-8 hover:prose-a:text-white/60">
                    {!! $service->content ?? $service->description !!}
                </div>
            </div>

            {{-- Right Side: The "Why Me" / Process Card (Sticky Bento Style) --}}
            <div class="lg:col-span-5 lg:sticky lg:top-10 h-fit">
                <div class="space-y-12">

                    {{-- Features Box: Bento Editorial --}}
                    <div class="p-12 bg-white/[0.02] border border-white/5 rounded-sm relative overflow-hidden group">
                        
                        {{-- Large Background Number for Editorial depth --}}
                        <div class="absolute -bottom-10 -right-10 text-[20vw] font-black text-white/[0.01] pointer-events-none">
                            {{ sprintf('%02d', count($service->features ?? [1,2,3,4])) }}
                        </div>

                        <h4 class="relative z-10 text-xs font-black uppercase tracking-[0.5em] text-white mb-12 pb-4 border-b border-white/10">Scope of Work</h4>

                        <ul class="relative z-10 space-y-8">
                            @php
                                $features = $service->features && is_array($service->features) && count($service->features) > 0 
                                            ? $service->features 
                                            : ['Strategic Consultation', 'Custom-Tailored Design', 'Performance Optimization', 'Post-Launch Support'];
                            @endphp
                            
                            @foreach ($features as $feature)
                                <li class="flex items-center justify-between group/item">
                                    <span class="text-sm font-bold uppercase tracking-widest text-white/40 group-hover/item:text-white transition-colors">
                                        {{ $feature }}
                                    </span>
                                    <div class="h-[1px] flex-grow mx-4 bg-white/5 group-hover/item:bg-orange-600/50 transition-colors"></div>
                                    <span class="font-mono text-[10px] text-orange-600 opacity-0 group-hover/item:opacity-100 transition-opacity">
                                        INCLUDED
                                    </span>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Final CTA Area inside Bento --}}
                        <div class="relative z-10 mt-20 pt-12 border-t border-white/5">
                            <h5 class="text-2xl font-bold uppercase tracking-tighter text-white mb-3">Initiate Project</h5>
                            <p class="text-white/40 text-sm font-light leading-relaxed mb-10 max-w-xs">Let's discuss how this tailored capability can transform your digital footprint.</p>

                            <a href="{{ route('home') }}#contact"
                                class="group relative block w-full text-center py-6 bg-black text-white overflow-hidden transition-all hover:pr-10">
                                <span class="relative z-10 text-xs font-black uppercase tracking-[0.3em]">
                                    Book a Consultation
                                </span>
                                <span class="absolute right-6 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all">→</span>
                                {{-- Hover fill effect --}}
                                <div class="absolute inset-0 bg-orange-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                            </a>
                        </div>
                    </div>

                    {{-- Trust Badge (Minimalist) --}}
                    <div class="px-10 py-6 bg-white/[0.01] border border-white/5 rounded-sm flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase tracking-[0.5em] text-white/30">Average Turnaround</span>
                        <div class="flex items-center gap-3">
                            <div class="h-[1px] w-6 bg-white/10"></div>
                            <span class="font-mono text-sm tracking-tighter text-white">{{ $service->turnaround_time ?? '14-28 Business Days' }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    {{-- 4. High-Contrast Editorial Footer CTA --}}
    <footer class="relative min-h-[70vh] flex flex-col items-center justify-center bg-white text-black rounded-t-[50px] md:rounded-t-[120px] px-6 text-center overflow-hidden">
        {{-- Background Large Text --}}
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] select-none pointer-events-none">
            <span class="text-[25vw] font-black tracking-[calc(-0.06em)] leading-none uppercase">Forge</span>
        </div>

        <div class="relative z-10">
            <p class="text-[10px] font-black uppercase tracking-[0.6em] mb-12 opacity-40 italic underline underline-offset-8">Collaboration</p>
            <h2 class="text-6xl md:text-[8vw] font-black tracking-[calc(-0.06em)] leading-[0.9] mb-16 uppercase italic">
                Ready to make <br /> an Impact?
            </h2>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
                <a href="{{ route('home') }}#contact"
                    class="group relative inline-flex items-center gap-6 px-16 py-8 bg-black text-white rounded-sm overflow-hidden transition-all hover:scale-105 active:scale-95 shadow-2xl">
                    <span class="text-xs font-black uppercase tracking-[0.4em] relative z-10">Start Project Now</span>
                    <span class="text-2xl relative z-10">→</span>
                    {{-- Hover fill effect --}}
                    <div class="absolute inset-0 bg-orange-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                </a>
                
                <a href="{{ route('home') }}#works"
                    class="text-xs font-black uppercase tracking-[0.4em] relative group overflow-hidden py-2">
                    <span class="block group-hover:-translate-y-full transition-transform duration-500">Explore Portfolio</span>
                    <span class="absolute top-full left-0 block group-hover:-translate-y-full transition-transform duration-500 underline underline-offset-4">Explore Portfolio</span>
                </a>
            </div>
        </div>
    </footer>

    <style>
        /* Editorial Typography Tweaks */
        h1, h2, h3, h4 { text-rendering: optimizeLegibility; -webkit-font-smoothing: antialiased; }
        
        /* Hide default scrollbar for a cleaner editorial look if needed */
        /* ::-webkit-scrollbar { width: 0px; background: transparent; } */

        /* Prevent prose from breaking the layout horizontally */
        .prose-container { max-width: 100%; overflow-x: hidden; }
        
        /* High-end Prose adjustments */
        .prose strong { color: white !important; font-weight: bold; }
        .prose blockquote p { color: white !important; opacity: 1; }
    </style>

</div>