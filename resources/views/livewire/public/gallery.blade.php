<div class="bg-[#070708] min-h-screen text-[#e5e5e5] antialiased selection:bg-orange-500 selection:text-white overflow-x-hidden"
    x-data="{
        modalOpen: @entangle('selectedMedia'),
        lockScroll(value) { document.body.style.overflow = value ? 'hidden' : 'auto'; }
    }" x-init="$watch('modalOpen', value => lockScroll(value))">

    @section('meta_title', 'Visual Archive — Reva Adhitya')

    {{-- Ambient BG --}}
    <div class="fixed inset-0 pointer-events-none z-0">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[35vw] font-black text-white/[0.015] select-none uppercase leading-none tracking-tighter">
            Archive
        </div>
    </div>

    <div class="relative z-10 max-w-[1440px] mx-auto px-5 md:px-10">

        {{-- Header --}}
        <header class="pt-40 pb-24">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-1.5 h-1.5 rounded-full bg-orange-500"></div>
                <div class="h-px w-10 bg-orange-500/40"></div>
                <p class="text-[9px] font-bold uppercase tracking-[0.5em] text-white/30">Visual Archive</p>
            </div>
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-10">
                <h1 class="text-[clamp(4rem,11vw,9rem)] font-black tracking-[-0.04em] leading-[0.85] uppercase"
                    style="font-family:'Bebas Neue','Arial Black',sans-serif;">
                    Frag<span class="text-transparent"
                        style="-webkit-text-stroke:1.5px rgba(255,255,255,0.2);">ments</span><span
                        class="text-orange-500">.</span>
                </h1>
                <p class="text-sm text-white/30 leading-relaxed font-light max-w-xs pb-2">
                    Curated moments and digital experiments from 2024–2026.
                </p>
            </div>
        </header>

        {{-- Controls bar --}}
        <div
            class="sticky top-0 z-50 bg-[#070708]/90 backdrop-blur-md border-y border-white/[0.06] py-4 mb-16 -mx-5 md:-mx-10 px-5 md:px-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                {{-- Type filter --}}
                <div class="flex items-center gap-1">
                    @foreach (['all', 'image', 'video'] as $t)
                        <button wire:click="setFilter('{{ $t }}')"
                            class="px-4 py-2 text-[9px] font-bold uppercase tracking-[0.25em] border transition-all duration-200
                                   {{ $filter === $t
                                       ? 'bg-orange-500 border-orange-500 text-white'
                                       : 'border-white/10 text-white/40 hover:border-white/30 hover:text-white' }}">
                            {{ $t }}
                        </button>
                    @endforeach
                </div>

                {{-- Sort + count --}}
                <div class="flex items-center gap-6">
                    <span class="text-[9px] font-mono text-white/20">
                        {{ count($media) }} <span class="text-orange-500/50">assets</span>
                    </span>
                    <div class="w-px h-4 bg-white/10"></div>
                    <div class="flex items-center gap-1">
                        <span class="text-[8px] uppercase tracking-[0.3em] text-white/20 mr-2">Sort</span>
                        @foreach (['date', 'name'] as $field)
                            <button wire:click="sortBy('{{ $field }}')"
                                class="px-3 py-2 text-[9px] font-bold uppercase tracking-[0.2em] border transition-all duration-200
                                       {{ $sortField === $field
                                           ? 'border-orange-500/50 text-orange-400 bg-orange-500/10'
                                           : 'border-white/10 text-white/30 hover:border-white/30 hover:text-white' }}">
                                {{ $field }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Masonry-style bento grid --}}
        @if (count($media) > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-32" style="grid-auto-rows: 280px;">
                @foreach ($media as $index => $item)
                    @php
                        $isWide = in_array($index % 7, [0, 5]);
                        $isTall = in_array($index % 7, [2, 6]);
                    @endphp
                    <div wire:key="media-{{ $index }}" wire:click="openMedia({{ json_encode($item) }})"
                        class="group relative cursor-pointer overflow-hidden bg-[#0d0d0e] border border-white/[0.06]
                   hover:border-orange-500/30 transition-all duration-500
                   {{ $isWide ? 'col-span-2' : 'col-span-1' }}
                   {{ $isTall ? 'row-span-2' : 'row-span-1' }}">

                        {{-- Image / Video fills 100% of the cell --}}
                        <div class="absolute inset-0">
                            @if ($item['type'] === 'image')
                                <img src="{{ $item['url'] }}" alt="{{ $item['name'] }}"
                                    class="w-full h-full object-cover scale-105 group-hover:scale-100 transition-transform duration-[1.5s]"
                                    loading="lazy">
                            @else
                                <video src="{{ $item['url'] }}"
                                    class="w-full h-full object-cover scale-105 group-hover:scale-100 transition-transform duration-[1.5s]"></video>
                            @endif
                        </div>

                        {{-- Hover overlay --}}
                        <div
                            class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-400 flex items-center justify-center">
                            @if ($item['type'] === 'video')
                                <div
                                    class="w-12 h-12 rounded-full border border-white/40 flex items-center justify-center bg-white/10 backdrop-blur-sm">
                                    <div
                                        class="w-0 h-0 border-y-[6px] border-y-transparent border-l-[10px] border-l-white ml-1">
                                    </div>
                                </div>
                            @else
                                <div
                                    class="w-9 h-9 border border-white/40 flex items-center justify-center bg-white/10 backdrop-blur-sm">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Bottom meta strip --}}
                        <div
                            class="absolute bottom-0 left-0 right-0 px-3 py-2.5
                        bg-gradient-to-t from-black/80 to-transparent
                        translate-y-full group-hover:translate-y-0 transition-transform duration-400">
                            <div class="flex items-center justify-between">
                                <p
                                    class="text-[8px] font-bold uppercase tracking-[0.2em] text-white/70 truncate max-w-[80%]">
                                    {{ $item['name'] }}
                                </p>
                                <span class="text-[8px] font-mono text-orange-400/70 flex-shrink-0">
                                    {{ sprintf('%02d', $index + 1) }}
                                </span>
                            </div>
                        </div>

                        {{-- Orange bottom line --}}
                        <div
                            class="absolute bottom-0 left-0 h-px w-0 bg-gradient-to-r from-orange-600 to-amber-400 group-hover:w-full transition-all duration-700">
                        </div>

                        {{-- Video badge --}}
                        @if ($item['type'] === 'video')
                            <div
                                class="absolute top-3 left-3 px-2 py-1 bg-[#0a0a0a]/90 border border-orange-500/30 text-[7px] font-bold uppercase tracking-[0.2em] text-orange-400">
                                Video
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    {{-- ══════════════════════
         FULLSCREEN MODAL
    ══════════════════════ --}}
    @if ($selectedMedia)
        <div class="fixed inset-0 z-[99999] flex items-center justify-center"
            x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            {{-- Backdrop --}}
            <div class="fixed inset-0 bg-black/95 backdrop-blur-md" wire:click="closeModal"></div>

            {{-- Close --}}
            <div class="fixed top-6 right-6 z-[100001]">
                <button wire:click="closeModal" class="group flex items-center gap-3 focus:outline-none">
                    <span
                        class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/30 group-hover:text-white transition-colors">Esc</span>
                    <div
                        class="w-10 h-10 border border-white/10 flex items-center justify-center
                                group-hover:bg-orange-500 group-hover:border-orange-500 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </button>
            </div>

            {{-- Media --}}
            <div class="relative z-[100000] w-full h-full flex flex-col items-center justify-center p-6 md:p-16"
                x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100">

                @if ($selectedMedia['type'] === 'image')
                    <img src="{{ $selectedMedia['url'] }}"
                        class="max-w-full max-h-[80vh] object-contain border border-white/[0.06]">
                @else
                    <video src="{{ $selectedMedia['url'] }}" controls autoplay
                        class="max-w-full max-h-[80vh] object-contain border border-white/[0.06]">
                    </video>
                @endif

                {{-- Caption bar --}}
                <div class="mt-5 flex items-center gap-4">
                    <div class="w-1.5 h-1.5 rounded-full bg-orange-500"></div>
                    <p class="text-[9px] font-bold uppercase tracking-[0.3em] text-white/40">
                        {{ $selectedMedia['name'] }}
                    </p>
                    @if ($selectedMedia['type'] === 'video')
                        <span
                            class="px-2 py-0.5 border border-orange-500/30 text-[7px] font-bold uppercase tracking-[0.2em] text-orange-400">Video</span>
                    @endif
                </div>
            </div>

            {{-- Keyboard hint --}}
            <div class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[100001]">
                <p class="text-[8px] font-mono text-white/15 tracking-widest">Click outside to close</p>
            </div>
        </div>
    @endif

    <style>
        h1,
        h2,
        h3,
        h4 {
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: #070708;
        }

        ::-webkit-scrollbar-thumb {
            background: #1a1a1c;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #f97316;
        }
    </style>

</div>
