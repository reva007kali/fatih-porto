<div class="bg-[#050507] min-h-screen text-white antialiased overflow-x-hidden"
    x-data="{
        modalOpen: @entangle('selectedMedia'),
        lockScroll(value) { document.body.style.overflow = value ? 'hidden' : 'auto'; }
    }" x-init="$watch('modalOpen', value => lockScroll(value))">

    @section('meta_title', 'Visual Archive | Sofyan Abdul Fatih')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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

        /* Sticky controls */
        .controls-bar {
            position: sticky; top: 0; z-index: 50;
            background: rgba(5,5,7,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        /* Filter pills */
        .filter-pill {
            padding: 7px 16px; border-radius: 100px;
            font-size: 9px; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase;
            border: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.3);
            background: transparent;
            transition: all 0.25s ease; cursor: pointer;
        }
        .filter-pill:hover {
            border-color: rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.7);
        }
        .filter-pill.active {
            background: linear-gradient(135deg, rgba(103,232,249,0.15), rgba(129,140,248,0.12));
            border-color: rgba(103,232,249,0.3);
            color: #67e8f9;
        }

        /* Grid items */
        .grid-item {
            position: relative; overflow: hidden; cursor: pointer;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.06);
            background: #0d0d12;
            transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
        }
        .grid-item:hover {
            border-color: rgba(103,232,249,0.2);
            transform: translateY(-3px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }
        .grid-item img,
        .grid-item video {
            position: absolute; inset: 0;
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 1.5s ease;
        }
        .grid-item:hover img,
        .grid-item:hover video { transform: scale(1.06); }

        .item-overlay {
            position: absolute; inset: 0; border-radius: 16px;
            background: rgba(5,5,7,0);
            display: flex; align-items: center; justify-content: center;
            transition: background 0.35s ease;
        }
        .grid-item:hover .item-overlay { background: rgba(5,5,7,0.55); }

        .item-icon {
            opacity: 0; transform: scale(0.8);
            transition: all 0.35s cubic-bezier(0.16,1,0.3,1);
        }
        .grid-item:hover .item-icon { opacity: 1; transform: scale(1); }

        .item-meta {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 10px 14px;
            background: linear-gradient(to top, rgba(5,5,7,0.85), transparent);
            border-radius: 0 0 16px 16px;
            transform: translateY(100%);
            transition: transform 0.35s cubic-bezier(0.16,1,0.3,1);
            display: flex; align-items: center; justify-content: space-between;
        }
        .grid-item:hover .item-meta { transform: translateY(0); }

        .item-sweep {
            position: absolute; bottom: 0; left: 0; right: 0; height: 2px;
            border-radius: 0 0 16px 16px;
            background: linear-gradient(90deg, #67e8f9, #818cf8, #a78bfa);
            transform: scaleX(0); transform-origin: left;
            transition: transform 0.6s cubic-bezier(0.16,1,0.3,1);
        }
        .grid-item:hover .item-sweep { transform: scaleX(1); }

        .video-badge {
            position: absolute; top: 10px; left: 10px; z-index: 10;
            padding: 4px 10px; border-radius: 100px;
            background: rgba(5,5,7,0.8);
            border: 1px solid rgba(103,232,249,0.2);
            font-size: 7px; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase;
            color: rgba(103,232,249,0.7);
            backdrop-filter: blur(8px);
        }

        .index-badge {
            position: absolute; top: 10px; right: 10px; z-index: 10;
            font-size: 8px; font-family: monospace; color: rgba(255,255,255,0.2);
        }

        /* Modal */
        .modal-media {
            max-width: 90vw; max-height: 80vh;
            object-fit: contain;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.07);
        }

        .modal-close-btn {
            width: 44px; height: 44px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(16px);
            transition: all 0.3s ease; cursor: pointer;
        }
        .modal-close-btn:hover {
            background: rgba(239,68,68,0.15);
            border-color: rgba(239,68,68,0.3);
        }

        ::-webkit-scrollbar { width: 3px; }
        ::-webkit-scrollbar-track { background: #050507; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 9999px; }
        ::selection { background: #67e8f9; color: #050507; }
    </style>

    {{-- Aurora fixed bg --}}
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="aurora-blob w-[700px] h-[700px] opacity-[0.07]" style="background: radial-gradient(circle, #67e8f9, transparent 70%); top: -200px; right: -150px; animation: auroraFloat 15s ease-in-out infinite;"></div>
        <div class="aurora-blob w-[500px] h-[500px] opacity-[0.06]" style="background: radial-gradient(circle, #818cf8, transparent 70%); top: 40%; left: -100px; animation: auroraFloat2 20s ease-in-out infinite;"></div>
        <div class="aurora-blob w-[400px] h-[400px] opacity-[0.05]" style="background: radial-gradient(circle, #34d399, transparent 70%); bottom: 15%; right: 10%; animation: auroraFloat 25s ease-in-out infinite reverse;"></div>
    </div>

    <div class="relative z-10">

        {{-- ══════════════════════════════════
             HERO HEADER — Centered
        ══════════════════════════════════ --}}
        <header class="pt-36 pb-20 px-6 text-center">
            <div class="max-w-[720px] mx-auto">

                <div class="pill-label mx-auto mb-8 w-fit"
                    style="animation: fadeUp 0.7s 0.1s ease both;">
                    Visual Archive · 2024–2026
                </div>

                <h1 class="text-[clamp(3.5rem,10vw,8rem)] font-black tracking-[-0.04em] leading-[0.88] uppercase text-white mb-6"
                    style="font-family:'Bebas Neue','Arial Black',sans-serif; animation: fadeUp 0.9s 0.2s cubic-bezier(0.16,1,0.3,1) both;">
                    FRAG<span class="gradient-text">MENTS.</span>
                </h1>

                <p class="text-base md:text-lg text-white/30 leading-relaxed font-light max-w-sm mx-auto"
                    style="animation: fadeUp 0.7s 0.32s ease both;">
                    Curated moments and digital experiments — images, motion, and visual exploration.
                </p>
            </div>
        </header>


        {{-- ══════════════════════════════════
             STICKY CONTROLS BAR
        ══════════════════════════════════ --}}
        <div class="controls-bar px-6 py-4">
            <div class="max-w-[1200px] mx-auto flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                {{-- Type filters --}}
                <div class="flex items-center gap-2">
                    <span class="text-[8px] font-bold uppercase tracking-[0.35em] text-white/15 mr-1">Type</span>
                    @foreach (['all', 'image', 'video'] as $t)
                    <button wire:click="setFilter('{{ $t }}')"
                        class="filter-pill {{ $filter === $t ? 'active' : '' }}">
                        {{ ucfirst($t) }}
                    </button>
                    @endforeach
                </div>

                {{-- Sort + count --}}
                <div class="flex items-center gap-4">
                    <span class="text-[9px] font-mono text-white/20">
                        {{ count($media) }}&nbsp;<span class="text-cyan-400/40">assets</span>
                    </span>
                    <div class="w-px h-4 bg-white/10"></div>
                    <div class="flex items-center gap-2">
                        <span class="text-[8px] uppercase tracking-[0.3em] text-white/15">Sort</span>
                        @foreach (['date', 'name'] as $field)
                        <button wire:click="sortBy('{{ $field }}')"
                            class="filter-pill {{ $sortField === $field ? 'active' : '' }}">
                            {{ ucfirst($field) }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        {{-- ══════════════════════════════════
             GALLERY GRID
        ══════════════════════════════════ --}}
        <div class="px-6 pt-10 pb-32">
            <div class="max-w-[1200px] mx-auto">

                @if (count($media) > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3"
                    style="grid-auto-rows: 260px;">
                    @foreach ($media as $index => $item)
                    @php
                        $isWide = in_array($index % 7, [0, 5]);
                        $isTall = in_array($index % 7, [2, 6]);
                    @endphp
                    <div wire:key="media-{{ $index }}"
                        wire:click="openMedia({{ json_encode($item) }})"
                        class="grid-item
                            {{ $isWide ? 'col-span-2' : 'col-span-1' }}
                            {{ $isTall ? 'row-span-2' : 'row-span-1' }}">

                        {{-- Media --}}
                        @if ($item['type'] === 'image')
                            <img src="{{ $item['url'] }}" alt="{{ $item['name'] }}" loading="lazy">
                        @else
                            <video src="{{ $item['url'] }}"></video>
                        @endif

                        {{-- Video badge --}}
                        @if ($item['type'] === 'video')
                        <div class="video-badge">Video</div>
                        @endif

                        {{-- Index --}}
                        <div class="index-badge">{{ sprintf('%02d', $index + 1) }}</div>

                        {{-- Hover overlay --}}
                        <div class="item-overlay">
                            @if ($item['type'] === 'video')
                            <div class="item-icon w-12 h-12 rounded-full flex items-center justify-center"
                                style="background: rgba(103,232,249,0.15); border: 1px solid rgba(103,232,249,0.3); backdrop-filter: blur(12px);">
                                <div class="w-0 h-0 border-y-[7px] border-y-transparent border-l-[12px] ml-1"
                                    style="border-left-color: #67e8f9;"></div>
                            </div>
                            @else
                            <div class="item-icon w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: rgba(103,232,249,0.15); border: 1px solid rgba(103,232,249,0.3); backdrop-filter: blur(12px);">
                                <svg class="w-4 h-4" style="color: #67e8f9;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            @endif
                        </div>

                        {{-- Meta strip --}}
                        <div class="item-meta">
                            <p class="text-[8px] font-bold uppercase tracking-[0.2em] text-white/60 truncate max-w-[80%]">
                                {{ $item['name'] }}
                            </p>
                            <span class="text-[8px] font-mono flex-shrink-0" style="color: rgba(103,232,249,0.5);">
                                {{ sprintf('%02d', $index + 1) }}
                            </span>
                        </div>

                        {{-- Sweep line --}}
                        <div class="item-sweep"></div>
                    </div>
                    @endforeach
                </div>

                @else
                {{-- Empty state --}}
                <div class="text-center py-40">
                    <p class="text-[5rem] font-black text-white/[0.03] mb-4"
                        style="font-family:'Bebas Neue',sans-serif;">EMPTY</p>
                    <p class="text-sm text-white/20 font-light">No media assets found.</p>
                </div>
                @endif

            </div>
        </div>

    </div>


    {{-- ══════════════════════════════════
         FULLSCREEN MODAL
    ══════════════════════════════════ --}}
    @if ($selectedMedia)
    <div class="fixed inset-0 z-[99999] flex items-center justify-center"
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black/92 backdrop-blur-xl" wire:click="closeModal"></div>

        {{-- Close button --}}
        <div class="fixed top-6 right-6 z-[100001] flex items-center gap-3">
            <span class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/25">Esc</span>
            <button wire:click="closeModal" class="modal-close-btn">
                <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Media container --}}
        <div class="relative z-[100000] flex flex-col items-center justify-center p-6 md:p-16 w-full"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-[0.96]"
            x-transition:enter-end="opacity-100 scale-100">

            @if ($selectedMedia['type'] === 'image')
                <img src="{{ $selectedMedia['url'] }}" alt="{{ $selectedMedia['name'] }}"
                    class="modal-media">
            @else
                <video src="{{ $selectedMedia['url'] }}" controls autoplay
                    class="modal-media"></video>
            @endif

            {{-- Caption --}}
            <div class="mt-6 flex items-center gap-4">
                <div class="w-5 h-px" style="background: linear-gradient(90deg, #67e8f9, transparent);"></div>
                <p class="text-[9px] font-bold uppercase tracking-[0.35em] text-white/35">
                    {{ $selectedMedia['name'] }}
                </p>
                @if ($selectedMedia['type'] === 'video')
                <span class="px-2.5 py-1 rounded-full text-[7px] font-bold uppercase tracking-[0.2em]"
                    style="background: rgba(103,232,249,0.08); border: 1px solid rgba(103,232,249,0.2); color: rgba(103,232,249,0.7);">
                    Video
                </span>
                @endif
            </div>
        </div>

        {{-- Bottom hint --}}
        <div class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[100001]">
            <p class="text-[8px] font-mono text-white/15 tracking-widest">Click outside or press Esc to close</p>
        </div>
    </div>
    @endif

</div>