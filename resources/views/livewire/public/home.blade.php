<div class="w-full bg-[#0b0b0d] text-white overflow-x-hidden relative" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 1000)">

    @section('meta_title', 'Reva Adhitya | Creative Developer & Designer')
    @section('meta_description',
        $hero->subtitle ??
        'Crafting high-performance digital experiences that merge aesthetic
        precision with technical excellence.')
    @section('meta_keywords',
        'Portfolio, Web Developer, Laravel, Livewire, Creative Developer, Indonesia, Reva
        Adhitya')
        @if ($hero->image)
            @section('meta_image', asset('storage/' . $hero->image))
        @endif

        {{-- Loading Screen --}}
        {{-- <div x-show="loading" x-transition:leave="transition ease-in-out duration-1000"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-full"
            class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-[#0b0b0d] text-white">


            <h1 class="text-6xl md:text-9xl font-black tracking-tighter mb-8 animate-pulse">
                REVALDY<span class="text-orange-500">.</span>
            </h1>


            <div class="w-64 h-1 bg-white/10 rounded-full overflow-hidden">
                <div class="h-full bg-orange-500 animate-loading-bar"></div>
            </div>

            <p class="mt-4 text-white/40 text-sm font-bold tracking-[0.2em] uppercase animate-pulse">
                Loading Experience...
            </p>
        </div> --}}

        {{-- Global Ambient Glow - Orange --}}
        <div
            class="fixed inset-0 bg-gradient-to-br from-orange-500/[0.03] via-transparent to-transparent pointer-events-none">
        </div>

        {{-- 3D Background Canvas --}}
        <div id="canvas-container" class="fixed inset-0 z-[20] pointer-events-none md:block hidden"></div>

        <!-- ================= HERO ================= -->
        <section id="home" class="relative min-h-screen flex items-end md:items-end overflow-hidden">

            {{-- Hero Background Image logic preserved --}}
            <div class="absolute inset-0 overflow-hidden">
                <img src="{{ asset('storage/' . ($hero->image ?? 'default.jpg')) }}" alt="Profile"
                    class="hero-img w-full h-full object-cover object-[80%_center] md:object-center transition-transform duration-700">

                {{-- Layered Overlays for Depth --}}
                <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#0b0b0d]/40 to-transparent"></div>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-[#050505]/60 via-transparent to-transparent hidden md:block">
                </div>

                {{-- Subtle Orange Ambient Glow --}}
                <div class="absolute top-1/4 -right-20 w-96 h-96 bg-orange-600/20 blur-[120px] rounded-full"></div>
            </div>

            <div class="relative z-10 w-full max-w-7xl mx-auto px-6 md:px-6 pb-10 md:pb-12 md:pt-20">

                {{-- Glass Content Box --}}
                <div class="max-w-3xl p-2 md:p-0">

                    {{-- Status Badge --}}
                    <div
                        class="inline-flex items-center gap-3 px-4 py-2 rounded-full border border-white/10 bg-white/5 backdrop-blur-md mb-4 animate-fade-in-up">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <span class="text-[8px] uppercase tracking-[0.2em] text-white/80">Available for new
                            projects</span>
                    </div>

                    {{-- Main Heading: Poster Style --}}
                    <h1
                        class="text-6xl md:text-7xl lg:text-8xl font-extrabold leading-[0.85] text-white mb-4 md:mb-8">
                        @php
                            $titleParts = explode(' ', $hero->title ?? 'Reva Adhitya');
                            $lastWord = array_pop($titleParts);
                            $firstPart = implode(' ', $titleParts);
                        @endphp

                        {{ $firstPart }} <br />
                        <span class="text-transparent font-bold bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">
                            {{ $lastWord }}<span class="text-white">.</span>
                        </span>
                    </h1>

                    {{-- Subtitle --}}
                    <p class="text-sm md:text-xl text-white/70 max-w-lg leading-relaxed mb-2 md:mb-12 font-medium">
                        {{ $hero->subtitle ?? 'I craft precise digital experiences with clarity & emotional impact.' }}
                    </p>

                    {{-- Action Group --}}
                    <div class="flex flex-col sm:flex-row items-center gap-4 md:gap-6 mb-4">
                        {{-- Main CTA --}}
                        <div class="flex flex-row items-center gap-4 w-full sm:w-auto justify-center">

                            {{-- Primary Button --}}
                            <a href="{{ $hero->cta_link ?? '#' }}"
                                class="group relative flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3.5 md:px-10 md:py-5 rounded-full overflow-hidden transition-all duration-300 active:scale-95 shadow-[0_20px_40px_-10px_rgba(255,107,0,0.3)] hover:shadow-[0_25px_50px_-10px_rgba(255,107,0,0.5)]">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-orange-600 to-orange-400 group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <span
                                    class="relative z-10 text-black font-bold uppercase tracking-widest text-[10px] md:text-xs group-hover:tracking-[0.2em] transition-all duration-500 whitespace-nowrap">
                                    {{ $hero->cta_text ?? 'Start a Project' }}
                                </span>
                            </a>

                            {{-- Download CV Button --}}
                            <a href="/cv.pdf" download
                                class="inline-flex flex-1 sm:flex-none items-center justify-center uppercase text-[10px] md:text-xs font-bold tracking-widest px-6 py-3.5 md:px-10 md:py-5 bg-white/5 border border-orange-700/50 text-white rounded-full hover:bg-orange-700/20 transition-all duration-300 backdrop-blur-sm whitespace-nowrap">
                                Download CV
                            </a>
                        </div>
                        {{-- Social Icons: Refined --}}
                        <div class="flex items-center gap-5 pl-2 sm:border-l sm:border-white/10 sm:pl-8">
                            @foreach ($social_links as $link)
                                <a href="{{ $link->url }}" target="_blank"
                                    class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center hover:bg-white hover:border-orange-500 group transition-all duration-500">
                                    @if ($link->icon)
                                        <img src="{{ asset('storage/' . $link->icon) }}"
                                            class="w-5 h-5 object-contain filter grayscale transition-all">
                                    @else
                                        <span
                                            class="text-[10px] font-black text-white/50 group-hover:text-black transition-colors">{{ substr($link->platform, 0, 1) }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </section>



        <!-- ================= FEATURED WORK ================= -->
        @if ($projects->count() > 0)
            <section id="works" class="py-24 bg-[#050505]">
                <div class="max-w-7xl mx-auto px-6 md:px-6">

                    {{-- Refined Header --}}
                    <div class="text-center max-w-4xl mx-auto mb-24 reveal-text">
                        <div
                            class="inline-flex items-center gap-3 mb-6 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                            </span>
                            <p class="text-orange-500 font-black tracking-[0.4em] uppercase text-[10px]">Portfolio</p>
                        </div>

                        <h3
                            class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white mb-8 leading-[0.9]">
                            Creative <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Highlights.</span>
                        </h3>

                        <a href="{{ route('works') }}" wire:navigate
                            class="inline-block text-sm font-semibold border-b border-orange-500/40 hover:border-orange-500 hover:text-orange-500 transition pb-1 text-white/60">
                            View All Projects →
                        </a>
                    </div>

                    <div class="relative">
                        {{-- Side Gradients --}}
                        <div
                            class="absolute inset-y-0 right-0 z-10 w-12 md:w-32 bg-gradient-to-l from-[#111113] via-[#111113]/50 to-transparent pointer-events-none">
                        </div>

                        <div class="swiper mySwiper !pb-14 relative z-6" id="works-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($projects as $project)
                                    <div class="swiper-slide !h-auto">
                                        <a href="{{ route('works.show', $project->slug) }}"
                                            class="relative aspect-[4/5] md:aspect-[5/3] rounded-[32px] overflow-hidden group border border-orange-500/20 hover:border-orange-500/40 bg-[#111113] block transition-all">
                                            @if ($project->image)
                                                @php
                                                    $fileUrl = Str::startsWith($project->image, 'http')
                                                        ? $project->image
                                                        : asset('storage/' . $project->image);
                                                    // Check extension more robustly
                                                    $extension = strtolower(
                                                        pathinfo($project->image, PATHINFO_EXTENSION),
                                                    );
                                                    $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv'];
                                                    $isVideo = in_array($extension, $videoExtensions);
                                                @endphp

                                                @if ($isVideo)
                                                    <video src="{{ $fileUrl }}" muted loop playsinline autoplay
                                                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110 opacity-70 group-hover:opacity-100"></video>
                                                @else
                                                    <img src="{{ $fileUrl }}"
                                                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110 opacity-70 group-hover:opacity-100">
                                                @endif
                                            @endif
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent p-8 lg:p-14 flex flex-col justify-end">
                                                <h4
                                                    class="text-lg lg:text-4xl leading-[1] font-bold mb-2 group-hover:text-orange-500 transition-colors">
                                                    {{ $project->title }}</h4>
                                                <div class="lg:max-w-[50%]">
                                                    <p class="text-sm text-white/60 line-clamp-2">
                                                        {{ $project->description }}
                                                    </p>
                                                </div>

                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>

                        {{-- Navigation Buttons --}}
                        <button
                            class="swiper-button-prev-custom hidden md:flex absolute top-1/2 -left-4 md:-left-20 -translate-y-1/2 z-10 w-12 h-12 rounded-full border border-white/10 bg-[#111113] items-center justify-center text-white/50 hover:text-orange-500 hover:border-orange-500 transition-all disabled:opacity-0 disabled:pointer-events-none">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            class="swiper-button-next-custom hidden md:flex absolute top-1/2 -right-4 md:-right-20 -translate-y-1/2 z-10 w-12 h-12 rounded-full border border-white/10 bg-[#111113] items-center justify-center text-white/50 hover:text-orange-500 hover:border-orange-500 transition-all disabled:opacity-0 disabled:pointer-events-none">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
        @endif


        <!-- ================= FEATURED WEBSITES ================= -->
        @if ($websites->count() > 0)
            <section id="websites" class="py-24 bg-[#050505]">
                <div class="max-w-7xl mx-auto px-6 md:px-6">

                    {{-- Refined Header --}}
                    <div class="text-center max-w-4xl mx-auto mb-24 reveal-text">
                        <div
                            class="inline-flex items-center gap-3 mb-6 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                            </span>
                            <p class="text-orange-500 font-black tracking-[0.4em] uppercase text-[10px]">Showcase</p>
                        </div>

                        <h3
                            class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white mb-8 leading-[0.9]">
                            Website <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Gallery.</span>
                        </h3>

                        <a href="{{ route('websites') }}" wire:navigate
                            class="inline-block text-sm font-semibold border-b border-orange-500/40 hover:border-orange-500 hover:text-orange-500 transition pb-1 text-white/60">
                            View All Websites →
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-10" id="websites-grid">
                        @foreach ($websites as $website)
                            <div
                                class="group relative aspect-[4/3] overflow-hidden rounded-[22px] bg-[#161618] border border-white/5 transition-all duration-500 hover:border-orange-500/50 hover:shadow-[0_0_30px_rgba(249,115,22,0.2)]">

                                {{-- Image Layer --}}
                                <div class="absolute inset-0 w-full h-full">
                                    @if ($website->image)
                                        <img src="{{ asset('storage/' . $website->image) }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 group-hover:blur-[2px]">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-zinc-800 text-white/20 font-black text-4xl">
                                            {{ substr($website->title, 0, 1) }}
                                        </div>
                                    @endif
                                </div>

                                {{-- Overlay Content (Visible on Hover) --}}
                                <div
                                    class="absolute inset-0 z-10 flex flex-col justify-end p-6 bg-gradient-to-t from-black via-black/80 to-transparent 
                    opacity-0 translate-y-4 transition-all duration-500 ease-out group-hover:opacity-100 group-hover:translate-y-0">

                                    {{-- Tags --}}
                                    @if ($website->tags)
                                        <div class="flex flex-wrap gap-2 mb-3">
                                            @foreach (array_slice($website->tags, 0, 2) as $tag)
                                                <span
                                                    class="px-2 py-0.5 rounded-full bg-orange-500/20 border border-orange-500/30 text-[9px] font-bold uppercase tracking-wider text-orange-400">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <h3 class="text-xl font-black text-white mb-2 tracking-tight">
                                        {{ $website->title }}
                                    </h3>

                                    <p class="text-xs text-white/70 line-clamp-2 leading-relaxed mb-4">
                                        {{ $website->description }}
                                    </p>

                                    {{-- Action Button --}}
                                    <a href="{{ route('websites.show', $website->slug) }}" target="_blank"
                                        class="w-full py-3 rounded-xl bg-orange-500 text-white font-black uppercase tracking-widest text-[10px] hover:bg-white hover:text-black transition-colors text-center">
                                        View Website
                                    </a>
                                </div>

                                {{-- Optional: Clickable link for the whole card --}}
                                <a href="{{ route('websites.show', $website->slug) }}" class="absolute inset-0 z-20"
                                    aria-label="View {{ $website->title }}"></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif


        <!-- ================= SERVICES ================= -->
        @if ($services->count() > 0)
            <section id="services" class="py-12 md:py-24 bg-[#020202] relative">
                <div id="servicesHeader" class="max-w-7xl mx-auto px-6 md:px-6">

                    {{-- Refined Header --}}
                    <div class="text-center max-w-4xl mx-auto mb-24 reveal-text">
                        <div
                            class="inline-flex items-center gap-3 mb-6 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                            </span>
                            <p class="text-orange-500 font-black tracking-[0.4em] uppercase text-[10px]">Expertise</p>
                        </div>

                        <h3
                            class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white mb-8 leading-[0.9]">
                            Specialized <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Solutions.</span>
                        </h3>

                        <p class="text-white/40 text-xl md:text-2xl leading-relaxed max-w-2xl mx-auto">
                            I build digital solutions that simplify, streamline, and strengthen brands with precision and
                            purpose.
                        </p>
                    </div>

                    {{-- Services Scroll List (Parallax Stack) --}}
                    <div class="relative z-10 space-y-22" id="services-container">
                        @foreach ($services as $index => $service)
                            <div class="service-card sticky top-32 transition-all duration-700 ease-out">
                                <a href="{{ route('services.show', $service->slug) }}"
                                    class="group relative block w-full max-w-7xl mx-auto z-[1]">

                                    {{-- The Card --}}
                                    <div
                                        class="relative h-full lg:min-h-[500px] p-10 rounded-[40px] bg-[#161618] border border-white/5 overflow-hidden transition-all duration-700 group-hover:border-orange-500/30 shadow-2xl">

                                        {{-- 1. Background Image Layer (Service Icon) --}}
                                        @if ($service->icon)
                                            <div class="absolute inset-0 w-full h-full overflow-hidden">
                                                <img src="{{ asset('storage/' . $service->icon) }}"
                                                    class="w-full h-full object-cover opacity-[0.75] group-hover:opacity-100 group-hover:scale-110 transition-all duration-1000 ease-out pointer-events-none">

                                                {{-- 2. Dark Gradient Overlay (Ensures Text Legibility) --}}
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-[#161618] via-[#161618]/80 to-transparent">
                                                </div>
                                            </div>
                                        @endif

                                        {{-- 3. Subtle Accent Glow --}}
                                        <div
                                            class="absolute -bottom-20 -right-20 w-64 h-64 bg-orange-600/10 blur-[100px] group-hover:bg-orange-600/30 transition-all duration-700">
                                        </div>

                                        {{-- 4. Top Decorative Elements (Numbering) --}}
                                        <div class="relative z-10 flex justify-between items-start mb-12">
                                            {{-- Dynamic Numbering --}}
                                            <div
                                                class="text-5xl lg:text-8xl font-black text-white/[0.05] group-hover:text-orange-500/20 transition-colors duration-500 italic">
                                                {{ sprintf('%02d', $index + 1) }}
                                            </div>
                                        </div>

                                        {{-- 5. Text Content --}}
                                        <div class="relative z-10">
                                            <h4
                                                class="text-3xl lg:text-6xl font-black text-white mb-4 tracking-tighter group-hover:text-orange-400 transition-colors">
                                                {{ $service->title }}
                                            </h4>
                                            <p
                                                class="text-white/50 leading-relaxed text-sm lg:text-2xl max-w-lg group-hover:text-white/80 transition-colors line-clamp-4">
                                                {{ $service->description }}
                                            </p>
                                        </div>

                                        {{-- 6. Bottom Interaction Reveal --}}
                                        <div
                                            class="absolute bottom-7 left-10 right-10 flex items-center justify-between opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="text-orange-500 text-[10px] font-black uppercase tracking-[0.3em]">Learn
                                                    More</span>
                                                <div
                                                    class="w-12 h-[1px] bg-orange-500/50 group-hover:w-20 transition-all duration-700">
                                                </div>
                                            </div>

                                            {{-- Tiny arrow indicator --}}
                                            <div
                                                class="w-8 h-8 rounded-full border border-orange-500/30 flex items-center justify-center text-orange-500 text-xs group-hover:bg-orange-500 group-hover:text-black transition-all">
                                                →
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif


        <!-- ================= WHY CHOOSE ME ================= -->
        @if ($features->count() > 0)
            <section id="features" class="py-24 relative bg-black">
                {{-- Section Background Ambient Glow --}}
                <div
                    class="absolute top-1/2 left-0 -translate-y-1/2 w-96 h-96 bg-orange-600/10 blur-[120px] rounded-full pointer-events-none">
                </div>

                <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10">
                    {{-- Refined Header --}}
                    <div class="text-center max-w-4xl mx-auto mb-24 reveal-text">
                        <div
                            class="inline-flex items-center gap-3 mb-6 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                            </span>
                            <p class="text-orange-500 font-black tracking-[0.4em] uppercase text-[10px]">Advantage</p>
                        </div>

                        <h3
                            class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white mb-8 leading-[0.9]">
                            Driven by <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Purpose.</span>
                        </h3>

                        <p class="text-white/40 text-xl md:text-2xl leading-relaxed max-w-2xl mx-auto">
                            Every decision is intentional. From strategy to execution, I design systems that perform, adapt,
                            and create measurable impact.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10" id="features-grid">
                        {{-- Feature Cards Grid --}}
                        @foreach ($features as $index => $feature)
                            <div
                                class="feature-card group relative p-10 rounded-[40px] border border-white/10 bg-[#1c1c1e]/50 backdrop-blur-sm overflow-hidden transition-all duration-700 ease-out hover:border-orange-500/40 hover:-translate-y-2 opacity-0 {{ $index % 2 == 0 ? 'translate-x-[-100px] translate-y-[100px]' : 'translate-x-[100px] translate-y-[100px]' }}">

                                {{-- Animated Blobs --}}
                                {{-- Blob 1 --}}
                                <div
                                    class="absolute -top-10 -right-10 w-40 h-40 bg-orange-600/20 rounded-full blur-[60px] group-hover:bg-orange-500/40 transition-colors duration-700 animate-blob">
                                </div>
                                {{-- Blob 2 --}}
                                <div
                                    class="absolute -bottom-10 -left-10 w-40 h-40 bg-orange-900/10 rounded-full blur-[60px] group-hover:bg-orange-600/30 transition-colors duration-700 animate-blob animation-delay-2000">
                                </div>

                                {{-- Card Content --}}
                                <div class="relative z-10">
                                    <div
                                        class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mb-8 group-hover:bg-orange-500 transition-all duration-500 group-hover:shadow-[0_0_30px_rgba(255,107,0,0.4)] group-hover:scale-110">
                                        @if ($feature->icon)
                                            <img src="{{ asset('storage/' . $feature->icon) }}"
                                                class="w-7 h-7 opacity-70 transition-all">
                                        @else
                                            <span class="text-2xl group-hover:scale-110 transition-transform">✦</span>
                                        @endif
                                    </div>

                                    <h4
                                        class="text-2xl font-bold mb-4 text-white group-hover:text-orange-400 transition-colors">
                                        {{ $feature->title }}
                                    </h4>

                                    <p class="text-white/50 leading-relaxed group-hover:text-white/80 transition-colors">
                                        {{ $feature->description }}
                                    </p>
                                </div>

                                {{-- Subtle Bottom Glow Line --}}
                                <div
                                    class="absolute bottom-0 left-0 h-[2px] w-0 bg-gradient-to-r from-transparent via-orange-500 to-transparent group-hover:w-full transition-all duration-700">
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif


        <!-- ================= ABOUT ================= -->
        <section id="about" class="relative py-32 overflow-hidden bg-[#000000]">

            {{-- Large Decorative Background Text --}}
            <div
                class="absolute top-1/2 left-0 -translate-y-1/2 text-[20vw] font-black text-white/[0.02] select-none pointer-events-none leading-none">
                STORY
            </div>

            <div class="max-w-7xl mx-auto px-6 md:px-6 relative z-10">
                {{-- Refined Header --}}
                <div class="text-center max-w-4xl mx-auto mb-24 reveal-text">
                    <div
                        class="inline-flex items-center gap-3 mb-6 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <p class="text-orange-500 font-black tracking-[0.4em] uppercase text-[10px]">Story</p>
                    </div>

                    <h3 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white mb-8 leading-[0.9]">
                        Designing <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Precision.</span>
                    </h3>

                    <p class="text-white/40 text-xl md:text-2xl leading-relaxed max-w-2xl mx-auto">
                        Form follows function, but emotion leads the way. I create digital experiences that resonate.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center relative z-10" id="about-grid">

                    {{-- 1. Image Side (Occupies 5 columns on desktop) --}}
                    <div class="lg:col-span-5 relative order-2 lg:order-1">

                        {{-- Decorative Floating Elements --}}
                        <div
                            class="absolute -top-10 -left-10 w-32 h-32 bg-orange-600/20 blur-[60px] rounded-full animate-pulse">
                        </div>
                        <div
                            class="absolute -bottom-10 -right-10 w-40 h-40 bg-orange-600/10 blur-[80px] rounded-full animate-blob">
                        </div>

                        {{-- The Image Frame --}}
                        <div class="relative">
                            {{-- Offset Border Frame --}}
                            <div
                                class="absolute inset-0 border-2 border-orange-500/20 translate-x-4 translate-y-4 rounded-[40px] hidden md:block">
                            </div>

                            {{-- Main Image Container --}}
                            <div
                                class="relative aspect-[4/5] rounded-[40px] overflow-hidden border border-white/10 bg-zinc-900 group shadow-2xl">
                                @if ($about->image)
                                    <img src="{{ asset('storage/' . $about->image) }}"
                                        class="w-full h-full object-cover object-top transition-transform duration-1000 group-hover:scale-110">
                                @endif

                                {{-- Image Overlay Gradient --}}
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Text Side (Occupies 7 columns on desktop) --}}
                    <div class="lg:col-span-7 order-1 lg:order-2 lg:pl-10">
                        <div class="max-w-xl">

                            {{-- Heading (Hidden now as moved to top) --}}
                            <div class="hidden">
                                <h2
                                    class="text-5xl md:text-7xl font-black tracking-tighter leading-[0.9] text-white mb-10">
                                    {{ $about->title ?? 'Designing Digital Precision.' }}
                                </h2>
                            </div>

                            {{-- Description with emphasis --}}
                            <div class="space-y-6">
                                <p class="text-xl md:text-2xl text-white/80 leading-relaxed font-medium">
                                    {{-- This assumes your first sentence is the hook --}}
                                    {{ Str::before($about->description, '.') }}.
                                </p>
                                <p class="text-lg text-white/40 leading-relaxed">
                                    {{ Str::after($about->description, '.') }}
                                </p>
                            </div>

                            {{-- Values/Features Mini-Grid --}}
                            <div class="grid grid-cols-2 gap-8 mt-12 py-8 border-y border-white/5">
                                <div>
                                    <h4 class="text-orange-500 font-black text-xs uppercase tracking-widest mb-2">
                                        Philosophy</h4>
                                    <p class="text-white/60 text-sm">Form follows function, but emotion leads the way.</p>
                                </div>
                                <div>
                                    <h4 class="text-orange-500 font-black text-xs uppercase tracking-widest mb-2">Location
                                    </h4>
                                    <p class="text-white/60 text-sm">Working globally, based in Indonesia.</p>
                                </div>
                            </div>

                            {{-- CTA --}}
                            @if (isset($about->button_text) && $about->button_text)
                                <div class="mt-12">
                                    <a href="{{ $about->button_link ?? '#' }}" class="group flex items-center gap-6">
                                        <div
                                            class="w-16 h-16 rounded-full border border-orange-500/30 flex items-center justify-center group-hover:bg-orange-500 group-hover:border-orange-500 transition-all duration-500">
                                            <span class="text-orange-500 group-hover:text-black transition-colors">→</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-white/40 text-[10px] font-black uppercase tracking-widest group-hover:text-orange-500 transition-colors">Next
                                                Step</span>
                                            <span
                                                class="text-white font-black text-lg group-hover:translate-x-2 transition-transform duration-500">{{ $about->button_text }}</span>
                                        </div>
                                    </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </section>




        <!-- ================= PRICING / INVESTMENT ================= -->
        <section id="pricing" class="py-32 relative z-[25] overflow-hidden bg-black">

            {{-- Background Decorative Glows --}}
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-600/5 blur-[120px] rounded-full pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-orange-900/5 blur-[120px] rounded-full pointer-events-none">
            </div>

            <div class="max-w-7xl mx-auto px-6 md:px-6 relative z-10">

                {{-- Header with Strategic Copy --}}
                <div class="text-center max-w-4xl mx-auto mb-24 reveal-text">
                    <div
                        class="inline-flex items-center gap-3 mb-6 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <p class="text-orange-500 font-black tracking-[0.4em] uppercase text-[10px]">Pricing</p>
                    </div>

                    <h2 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white mb-8 leading-[0.9]">
                        Ready to <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Level
                            Up?</span>
                    </h2>

                    <p class="text-white/40 text-xl md:text-2xl leading-relaxed max-w-2xl mx-auto">
                        Choose a plan that fits your stage of growth. No hidden fees, just high-impact digital solutions
                        designed to convert.
                    </p>
                </div>

                {{-- Pricing Bento Grid --}}
                <div class="max-w-7xl mx-auto px-4 py-12 relative z-10" id="pricing-grid">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-6">
                        @foreach ($pricing_plans as $index => $plan)
                            @php
                                // Logic to make the middle/popular card stand out in the Bento Grid
                                $isMain = $index === 1; // Assuming the 2nd plan is the "Pro" one
                                $gridClass = $isMain
                                    ? 'lg:col-span-4'
                                    : ($index === 0
                                        ? 'lg:col-span-4'
                                        : 'lg:col-span-4');
                            @endphp

                            <div
                                class="{{ $gridClass }} group relative flex flex-col bg-[#111113] rounded-[32px] border border-white/5 overflow-hidden transition-all duration-500 hover:border-orange-500/40 hover:shadow-[0_0_40px_-15px_rgba(249,115,22,0.2)]">

                                {{-- Background Glow Decoration --}}
                                <div
                                    class="absolute -top-24 -right-24 w-48 h-48 bg-orange-500/10 blur-[80px] rounded-full group-hover:bg-orange-500/20 transition-all duration-700">
                                </div>

                                {{-- Card Content --}}
                                <div class="relative z-10 flex flex-col h-full p-8 md:p-10">

                                    {{-- Header --}}
                                    <div class="mb-8">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-orange-500 font-bold text-sm uppercase tracking-[0.2em]">
                                                {{ $plan->name }}
                                            </h3>
                                            @if ($isMain)
                                                <span
                                                    class="bg-orange-500 text-black text-[10px] font-black px-3 py-1 rounded-full uppercase">
                                                    Most Popular
                                                </span>
                                            @endif
                                        </div>

                                        <div class="flex items-baseline gap-1">
                                            <span class="text-4xl md:text-5xl font-black text-white tracking-tighter">
                                                {{ $plan->price }}
                                            </span>
                                        </div>

                                        <p class="mt-4 text-white/50 text-sm leading-relaxed max-w-[280px]">
                                            {{ $plan->description }}
                                        </p>
                                    </div>

                                    {{-- Bento Feature List (Visible by default in Bento style) --}}


                                    {{-- CTA Button --}}
                                    <div class="mt-auto">
                                        <a href="{{ $plan->cta_link ?? '#' }}"
                                            class="relative group/btn overflow-hidden block w-full text-center py-4 rounded-2xl font-bold uppercase tracking-widest text-[11px] transition-all duration-300 {{ $isMain ? 'bg-orange-500 text-black' : 'bg-white/5 text-white hover:bg-white/10' }} border border-white/5">

                                            <span class="relative z-10">{{ $plan->cta_text ?? 'Get Started' }}</span>

                                            {{-- Shine effect on hover --}}
                                            <div
                                                class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover/btn:animate-shine">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <style>
                    @keyframes shine {
                        100% {
                            transform: translateX(100%);
                        }
                    }

                    .animate-shine {
                        animation: shine 0.8s forwards;
                    }
                </style>

                {{-- Bottom Value Proposition --}}
                <div
                    class="mt-20 p-10 rounded-[40px] border border-white/5 bg-white/[0.01] flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-orange-500/10 flex items-center justify-center">
                            <span class="text-orange-500 text-3xl">💡</span>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-white">Need a custom solution?</h4>
                            <p class="text-white/40">If your project doesn't fit these plans, let's talk and build a custom
                                quote.</p>
                        </div>
                    </div>
                    <a href="#contact"
                        class="text-orange-500 font-black uppercase tracking-widest text-sm border-b-2 border-orange-500/20 hover:border-orange-500 transition-all pb-1">
                        Contact for Custom Work →
                    </a>
                </div>
            </div>
        </section>



        <!-- ================= TESTIMONIALS ================= -->
        <section id="testimonials"
            class="py-24 bg-gradient-to-b mt-10 relative from-black to-black/90 text-white rounded-[40px] md:rounded-[60px] mx-4 shadow-2xl shadow-orange-500/5">
            <div class="max-w-7xl mx-auto">

                {{-- Refined Header --}}
                <div class="text-center max-w-4xl mx-auto mb-24 reveal-text">
                    <div
                        class="inline-flex items-center gap-3 mb-6 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <p class="text-orange-500 font-black tracking-[0.4em] uppercase text-[10px]">Reviews</p>
                    </div>

                    <h3 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white mb-8 leading-[0.9]">
                        Client <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Feedback.</span>
                    </h3>

                    <p class="text-white/40 text-xl md:text-2xl leading-relaxed max-w-2xl mx-auto">
                        Trust is earned. Here's what my partners have to say about our collaboration.
                    </p>
                </div>

                <div class="swiper testimonialSwiper !pb-12 relative z-10" id="testimonials-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide !h-auto py-10"> {{-- Added padding for hover lift --}}
                                <div class="group relative h-full transition-all duration-500">

                                    {{-- 1. Hover Glow Effect (Behind the card) --}}
                                    <div
                                        class="absolute -inset-2 bg-gradient-to-r from-orange-600 to-orange-400 rounded-[45px] opacity-0 group-hover:opacity-20 blur-2xl transition-opacity duration-500">
                                    </div>

                                    {{-- 2. Main Glass Card --}}
                                    <div
                                        class="relative h-full flex flex-col p-8 md:p-10 rounded-[40px] bg-white/[0.03] backdrop-blur-xl border border-white/10 group-hover:border-orange-500/50 group-hover:-translate-y-2 transition-all duration-500 shadow-2xl">

                                        {{-- Decorative Quote Icon --}}
                                        <div
                                            class="absolute top-8 right-10 text-orange-500/10 group-hover:text-orange-500/20 transition-colors">
                                            <svg class="w-16 h-16 fill-currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V12C14.017 12.5523 13.5693 13 13.017 13H11.017C10.4647 13 10.017 12.5523 10.017 12V9C10.017 7.34315 11.3601 6 13.017 6H19.017C20.6738 6 22.017 7.34315 22.017 9V15C22.017 17.7614 19.7784 20 17.017 20H14.017V21ZM5.017 21L5.017 18C5.017 16.8954 5.91243 16 7.017 16H10.017C10.5693 16 11.017 15.5523 11.017 15V9C11.017 8.44772 10.5693 8 10.017 8H6.017C5.46472 8 5.017 8.44772 5.017 9V12C5.017 12.5523 4.56929 13 4.017 13H2.017C1.46472 13 1.017 12.5523 1.017 12V9C1.017 7.34315 2.36015 6 4.017 6H10.017C11.6738 6 13.017 7.34315 13.017 9V15C13.017 17.7614 10.7786 20 8.017 20H5.017V21Z" />
                                            </svg>
                                        </div>

                                        {{-- Star Rating --}}
                                        <div class="flex gap-1 mb-8">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 text-orange-500 group-hover:scale-110 transition-transform duration-300"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>

                                        {{-- Testimonial Content --}}
                                        <p
                                            class="text-xl md:text-2xl leading-relaxed text-white/90 mb-10 font-medium italic">
                                            "{{ $testimonial->content }}"
                                        </p>

                                        {{-- Author Info --}}
                                        <div class="flex items-center gap-5 mt-auto">
                                            <div class="relative">
                                                {{-- Avatar Ring --}}
                                                <div
                                                    class="absolute -inset-1 bg-gradient-to-tr from-orange-600 to-orange-400 rounded-full opacity-50">
                                                </div>
                                                <div
                                                    class="relative w-16 h-16 rounded-full overflow-hidden border-2 border-[#0b0b0d] bg-zinc-800">
                                                    @if ($testimonial->avatar)
                                                        <img src="{{ asset('storage/' . $testimonial->avatar) }}"
                                                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                                                    @else
                                                        <div
                                                            class="w-full h-full flex items-center justify-center text-white/20 font-black">
                                                            {{ substr($testimonial->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-lg font-black text-white group-hover:text-orange-500 transition-colors">
                                                    {{ $testimonial->name }}
                                                </h4>
                                                <p
                                                    class="text-[10px] text-orange-500/60 font-black uppercase tracking-[0.2em]">
                                                    {{ $testimonial->position ?? 'CEO & Founder' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <div class="max-w-2xl mx-auto mt-12">
                    <livewire:public.components.testimonial-form />
                </div>
            </div>
        </section>

        <!-- ================= CONTACT ================= -->
        <section id="contact" class="py-24">
            <div class="max-w-7xl mx-auto px-6 md:px-6">

                {{-- Refined Header --}}
                <div class="text-center max-w-4xl mx-auto mb-24 reveal-text">
                    <div
                        class="inline-flex items-center gap-3 mb-6 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <p class="text-orange-500 font-black tracking-[0.4em] uppercase text-[10px]">Contact</p>
                    </div>

                    <h3 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white mb-8 leading-[0.9]">
                        Let's<span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Connect.</span>
                    </h3>

                    <p class="text-white/40 text-xl md:text-2xl leading-relaxed max-w-2xl mx-auto">
                        Ready to start your next project? I am currently available for new opportunities.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                    <div class="hidden">
                        <p class="text-orange-500 font-bold tracking-[0.3em] uppercase text-xs mb-4">Contact</p>
                        <h2 class="text-5xl md:text-7xl font-bold leading-tight mb-8">Let's build your <span
                                class="text-orange-500">vision.</span></h2>
                        <p class="text-xl text-white/50 leading-relaxed mb-12">I am currently available for new projects
                            and collaborations. Send me a message and let's talk.</p>
                    </div>

                    <div
                        class="lg:col-span-2 max-w-3xl mx-auto w-full relative z-10
                bg-gradient-to-br from-orange-500/5 to-orange-600/5 p-8 md:p-12 rounded-[40px] border border-orange-500/20 backdrop-blur-xl">
                        @if (session()->has('message'))
                            <div
                                class="mb-8 p-4 rounded-2xl bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm shadow-lg">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="sendMessage" class="space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <input type="text" wire:model="name" placeholder="Name"
                                    class="w-full px-6 py-4 rounded-2xl bg-white/5 border border-orange-500/20 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all"
                                    required>
                                <input type="email" wire:model="email" placeholder="Email"
                                    class="w-full px-6 py-4 rounded-2xl bg-white/5 border border-orange-500/20 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all"
                                    required>
                            </div>
                            <input type="text" wire:model="subject" placeholder="Subject"
                                class="w-full px-6 py-4 rounded-2xl bg-white/5 border border-orange-500/20 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all">
                            <textarea wire:model="message" rows="5" placeholder="Your Message"
                                class="w-full px-6 py-4 rounded-2xl bg-white/5 border border-orange-500/20 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 outline-none transition-all resize-none"
                                required></textarea>
                            <button type="submit"
                                class="w-full py-5 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold uppercase tracking-widest text-sm hover:from-orange-600 hover:to-orange-700 hover:shadow-lg hover:shadow-orange-500/30 transition-all active:scale-95">Send
                                Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= SCRIPTS ================= -->
        <script>
            document.addEventListener('livewire:navigated', () => {
                initAllSwipers();
                initParallaxStack();
                initRevealText();
                initFeaturesScroll();
            });
            document.addEventListener('DOMContentLoaded', () => {
                initAllSwipers();
                initParallaxStack();
                initRevealText();
                initFeaturesScroll();
            });

            function initFeaturesScroll() {
                const grid = document.getElementById('features-grid');
                if (!grid) return;

                const cards = grid.querySelectorAll('.feature-card');

                // Helper to check if element is odd/even in grid context for direction
                // In grid-cols-2: 
                // Index 0 (Left) -> Slide in from Bottom-Left
                // Index 1 (Right) -> Slide in from Bottom-Right

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        const el = entry.target;
                        const isLeft = Array.from(cards).indexOf(el) % 2 === 0;

                        if (entry.isIntersecting) {
                            // ENTRY: Reset transforms to 0
                            el.classList.remove('opacity-0', 'translate-y-[100px]', 'translate-x-[-100px]',
                                'translate-x-[100px]');
                            el.classList.add('opacity-100', 'translate-y-0', 'translate-x-0');
                        } else {
                            // EXIT: Apply transforms based on position
                            // We check if we scrolled PAST it (it went up) or BEFORE it (it went down)
                            const rect = el.getBoundingClientRect();

                            // Only animate out if we are significantly away to avoid flickering
                            // Logic: Reset to initial state so it can animate in again
                            el.classList.remove('opacity-100', 'translate-y-0', 'translate-x-0');
                            el.classList.add('opacity-0', 'translate-y-[100px]');

                            // Add directional offset back
                            if (isLeft) {
                                el.classList.add('translate-x-[-100px]');
                            } else {
                                el.classList.add('translate-x-[100px]');
                            }
                        }
                    });
                }, {
                    threshold: 0.15, // 15% visibility triggers entry
                    rootMargin: '0px 0px -10% 0px' // Offset bottom slightly so it triggers "inside" view
                });

                cards.forEach(card => {
                    observer.observe(card);
                });
            }

            function initRevealText() {
                const revealElements = document.querySelectorAll('.reveal-text');

                // BREAKPOINT CHECK: 
                // If screen width is less than 1024px (Tablets/Mobile), 
                // show text immediately and stop the function.
                if (window.innerWidth < 1024) {
                    revealElements.forEach(el => {
                        el.classList.add('is-visible');
                    });
                    return;
                }

                // EXISTING LOGIC (Only runs on large screens now)
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            // Optional: Stop observing once revealed to save performance
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.2,
                    rootMargin: '0px 0px -50px 0px'
                });

                revealElements.forEach(el => {
                    observer.observe(el);
                });
            }

            function initParallaxStack() {
                const container = document.getElementById('services-container');
                if (!container) return;

                const cards = container.querySelectorAll('.service-card');

                const handleScroll = () => {
                    const windowHeight = window.innerHeight;
                    const windowCenter = windowHeight / 1.7;

                    cards.forEach((card, index) => {
                        const rect = card.getBoundingClientRect();
                        const cardCenter = rect.top + (rect.height / 2);

                        // Distance from center of viewport (signed)
                        const dist = cardCenter - windowCenter;
                        const absDist = Math.abs(dist);

                        // Progress: 0 at center, 1 at distance of 60% viewport height
                        let progress = absDist / (windowHeight * 0.6);
                        progress = Math.max(0, Math.min(progress, 1));

                        // Styles
                        const scale = 1 - (progress * 0.2); // 1 -> 0.8
                        const opacity = 1 - (progress * 0.5); // 1 -> 0.3
                        const blur = progress * 0; // 0px -> 5px
                        const rotateX = (dist / windowHeight) * 20; // Rotate based on scroll direction

                        // Apply
                        card.style.transform = `scale(${scale}) perspective(1000px) rotateX(${rotateX}deg)`;
                        card.style.opacity = opacity;
                        card.style.filter = `blur(${blur}px)`;

                        // Z-Index logic: Card closest to center gets highest Z
                        // We inverse the progress for Z-index
                        card.style.zIndex = Math.round((1 - progress) * 100);
                    });
                };

                window.addEventListener('scroll', handleScroll);
                handleScroll(); // Init
            }

            function initAllSwipers() {
                // Pricing Swiper (Coverflow)
                new Swiper('.pricingSwiper', {
                    effect: 'coverflow',
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    initialSlide: 1, // Start at the middle card (assuming 3 cards)
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 0,
                        depth: 100,
                        modifier: 2.5,
                        slideShadows: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    breakpoints: {
                        // When window width is <= 640px (Mobile)
                        320: {
                            effect: 'slide', // Disable coverflow on mobile for better UX
                            slidesPerView: 1.1,
                            spaceBetween: 20,
                            centeredSlides: true,
                        },
                        // Desktop
                        768: {
                            effect: 'coverflow',
                            slidesPerView: 'auto',
                        }
                    }
                });

                // Services Swiper (3D Perspective Vertical)
                new Swiper('.servicesSwiper', {
                    direction: 'vertical',
                    effect: 'coverflow',
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    spaceBetween: 30,
                    initialSlide: 0,
                    mousewheel: {
                        invert: false,
                        forceToAxis: true,
                        sensitivity: 1,
                        releaseOnEdges: true,
                    },
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 0,
                        depth: 100,
                        modifier: 2.5,
                        slideShadows: true,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        dynamicBullets: true,
                    },
                });

                // Projects Swiper
                new Swiper('.mySwiper', {
                    slidesPerView: 1.2,
                    spaceBetween: 20,
                    grabCursor: true,
                    speed: 500,
                    effect: 'slide',
                    easing: 'ease-in-out',
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next-custom',
                        prevEl: '.swiper-button-prev-custom',
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2.2,
                            spaceBetween: 30
                        },
                        1024: {
                            slidesPerView: 1.5,
                            spaceBetween: 40
                        }
                    }
                });

                // Testimonials Swiper
                new Swiper(".testimonialSwiper", {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    grabCursor: true,
                    autoplay: {
                        delay: 5000
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 2
                        },
                        1024: {
                            slidesPerView: 2
                        }
                    }
                });
            }
        </script>

        <style>
            .reveal-text {
                opacity: 0.1;
                filter: blur(8px);
                transform: translateY(30px);
                transition: all 1.5s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .reveal-text.is-visible {
                opacity: 1;
                filter: blur(0);
                transform: translateY(0);
            }

            [x-cloak] {
                display: none !important;
            }

            @keyframes loading-bar {
                0% {
                    width: 0%;
                }

                100% {
                    width: 100%;
                }
            }

            .animate-loading-bar {
                animation: loading-bar 0.5s ease-in-out forwards;
            }

            @keyframes fade-in-up {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in-up {
                animation: fade-in-up 1s ease-out forwards;
            }

            @keyframes bounce-slow {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            .animate-bounce-slow {
                animation: bounce-slow 4s ease-in-out infinite;
            }

            @keyframes blob {
                0% {
                    transform: translate(0px, 0px) scale(1);
                }

                33% {
                    transform: translate(30px, -50px) scale(1.1);
                }

                66% {
                    transform: translate(-20px, 20px) scale(0.9);
                }

                100% {
                    transform: translate(0px, 0px) scale(1);
                }
            }

            .animate-blob {
                animation: blob 7s infinite;
            }

            .animation-delay-2000 {
                animation-delay: 2s;
            }

            /* Orange-themed Swiper pagination */
            .swiper-pagination-bullet {
                background: rgba(249, 115, 22, 0.3);
            }

            .swiper-pagination-bullet-active {
                background: rgb(249, 115, 22);
            }

            #robot-tooltip {
                position: fixed;
                top: 0;
                left: 0;
                pointer-events: none;
                /* Supaya tidak menghalangi klik ke robot */
                background: rgba(22, 22, 24, 0.9);
                color: white;
                padding: 8px 14px;
                border-radius: 8px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
                z-index: 9999;
                transition: opacity 0.3s ease, transform 0.3s ease;
                white-space: nowrap;
            }

            .robot-tooltip-hidden {
                opacity: 0;
                transform: translate(-50%, -100%) scale(0.8);
            }

            .robot-tooltip-visible {
                opacity: 1;
                transform: translate(-50%, -120%) scale(1);
            }

            .tooltip-arrow {
                position: absolute;
                bottom: -5px;
                left: 50%;
                transform: translateX(-50%);
                width: 0;
                height: 0;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-top: 5px solid rgba(22, 22, 24, 0.9);
            }
        </style>
    </div>
