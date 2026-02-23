<div class="min-h-screen bg-[#0b0b0d] text-white antialiased selection:bg-orange-500 selection:text-white">

    {{-- 1. Floating Back Button --}}
    <div class="fixed bottom-8 left-6 md:left-12 z-[100]">
        <button type="button" x-on:click="window.history.back()"
            class="group flex items-center justify-center w-14 h-14 rounded-full bg-zinc-900/40 backdrop-blur-xl border border-white/10 hover:border-orange-500/50 transition-all duration-500 hover:scale-110 shadow-2xl focus:outline-none"
            title="Go Back">

            {{-- Tooltip (Optional, shows on hover) --}}
            <span
                class="absolute left-16 scale-0 group-hover:scale-100 transition-all origin-left bg-orange-600 text-white text-[10px] font-bold uppercase tracking-widest py-1 px-3 rounded-md shadow-xl whitespace-nowrap pointer-events-none">
                Go Back
            </span>

            <svg class="w-6 h-6 text-orange-500 group-hover:-translate-x-1 transition-transform" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
    </div>

    {{-- 2. Atmospheric Hero Section --}}
    <header class="relative min-h-[60vh] flex items-end pt-24 pb-10 overflow-hidden">
        {{-- Background Texture (Service Icon used as a large watermark) --}}
        @if ($service->icon)
            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1/2 h-full opacity-20 pointer-events-none">
                <img src="{{ asset('storage/' . $service->icon) }}"
                    class="w-full h-full object-contain filter grayscale blur-sm">
            </div>
        @endif

        {{-- Ambient Glows --}}
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-orange-600/10 blur-[120px] rounded-full"></div>

        <div class="relative w-full max-w-7xl mx-auto px-6 md:px-12">
            <div class="max-w-4xl">
                {{-- Breadcrumb Label --}}
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-12 h-[2px] bg-orange-500"></span>
                    <span class="text-orange-500 text-xs font-black uppercase tracking-[0.4em]">Expertise /
                        {{ $service->title }}</span>
                </div>

                <h1
                    class="text-5xl md:text-6xl lg:text-6xl font-black tracking-tighter leading-[0.85] text-white mb-10">
                    {{ $service->title }}<span class="text-orange-500">.</span>
                </h1>

                <p class="text-xl md:text-3xl text-white/40 font-medium leading-relaxed max-w-2xl">
                    {{ Str::limit(strip_tags($service->description), 150) }}
                </p>
            </div>
        </div>
    </header>

    {{-- 3. Content Strategy Section --}}
    <main class="max-w-7xl mx-auto px-6 md:px-12 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24">

            {{-- Left Side: Deep Dive Content --}}
            <div class="lg:col-span-7">
                <div class="flex items-center gap-4 mb-12">
                    <div
                        class="w-16 h-16 rounded-3xl bg-[#161618] border border-white/10 flex items-center justify-center">
                        @if ($service->icon)
                            <img src="{{ asset('storage/' . $service->icon) }}" class="w-8 h-8 object-contain">
                        @else
                            <span class="text-orange-500 font-black text-2xl">✦</span>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-white font-black text-xl tracking-tight">Service Overview</h3>
                        <p class="text-orange-500 font-bold text-[10px] uppercase tracking-widest">In-depth capabilities
                        </p>
                    </div>
                </div>

                <div
                    class="prose prose-invert prose-lg max-w-none text-white/60 leading-relaxed
                            prose-headings:text-white prose-headings:font-black prose-headings:tracking-tighter
                            prose-strong:text-orange-400 prose-blockquote:border-orange-500">
                    {!! $service->content ?? $service->description !!}
                </div>
            </div>

            {{-- Right Side: The "Why Me" / Process Card --}}
            <div class="lg:col-span-5">
                <div class="sticky top-32 space-y-8">

                    {{-- Features Box --}}
                    <div class="p-10 rounded-[48px] bg-[#161618] border border-white/5 relative overflow-hidden group">
                        {{-- Subtle hover glow --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-orange-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                        </div>

                        <h4 class="relative z-10 text-white font-black text-xl mb-8 tracking-tight">What's Included</h4>

                        <ul class="relative z-10 space-y-6">
                            @if ($service->features && is_array($service->features) && count($service->features) > 0)
                                @foreach ($service->features as $feature)
                                    <li class="flex items-start gap-4 group/item">
                                        <div
                                            class="mt-1 w-5 h-5 rounded-full border border-orange-500/30 flex items-center justify-center group-hover/item:border-orange-500 transition-colors">
                                            <span class="text-orange-500 text-[10px]">✓</span>
                                        </div>
                                        <span
                                            class="text-sm font-bold text-white/60 group-hover/item:text-white transition-colors">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            @else
                                @foreach (['Strategic Consultation', 'Custom-Tailored Design', 'Performance Optimization', 'Post-Launch Support'] as $feature)
                                    <li class="flex items-start gap-4 group/item">
                                        <div
                                            class="mt-1 w-5 h-5 rounded-full border border-orange-500/30 flex items-center justify-center group-hover/item:border-orange-500 transition-colors">
                                            <span class="text-orange-500 text-[10px]">✓</span>
                                        </div>
                                        <span
                                            class="text-sm font-bold text-white/60 group-hover/item:text-white transition-colors">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                        <div class="relative z-10 mt-12 pt-10 border-t border-white/5">
                            <p class="text-white font-black text-lg mb-2">Ready to start?</p>
                            <p class="text-white/40 text-xs mb-8">Let's discuss how this service can transform your
                                brand.</p>

                            <a href="{{ route('home') }}#contact"
                                class="block w-full text-center py-5 rounded-full bg-orange-600 text-black font-black uppercase tracking-widest text-xs hover:bg-orange-500 transition-all shadow-xl shadow-orange-600/10">
                                Book a Consultation
                            </a>
                        </div>
                    </div>

                    {{-- Trust Badge --}}
                    <div
                        class="px-10 py-6 rounded-full border border-white/5 bg-white/[0.02] flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-widest text-white/30">Average
                            Turnaround</span>
                        <span class="text-orange-500 font-bold">{{ $service->turnaround_time ?? '2-4 Weeks' }}</span>
                    </div>

                </div>
            </div>
        </div>
    </main>

    {{-- 4. Footer Call-to-Action --}}
    <footer
        class="relative py-32 overflow-hidden bg-white text-black rounded-t-[60px] md:rounded-t-[100px] text-center px-6">
        {{-- Background Large Text --}}
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[15vw] font-black text-black/[0.03] select-none pointer-events-none">
            ACTION
        </div>

        <div class="relative z-10 max-w-3xl mx-auto">
            <p class="text-gray-400 font-black uppercase tracking-[0.4em] text-xs mb-8">Collaborate</p>
            <h2 class="text-5xl md:text-8xl font-black tracking-tighter mb-12">Let's build <br /> something epic.</h2>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="{{ route('home') }}#contact"
                    class="px-12 py-6 rounded-full bg-black text-white font-black uppercase tracking-widest text-sm hover:bg-orange-600 transition-all active:scale-95">
                    Start Project Now
                </a>
                <a href="{{ route('home') }}#works"
                    class="font-black uppercase tracking-widest text-xs border-b-2 border-black/10 hover:border-black transition-all pb-1">
                    View Portfolio
                </a>
            </div>
        </div>
    </footer>

</div>
