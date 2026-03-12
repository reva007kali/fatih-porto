<div class="bg-[#070708] min-h-screen text-[#e5e5e5] pt-40 pb-32" x-data="{
    modalOpen: @entangle('selectedMedia'),
    lockScroll(value) {
        document.body.style.overflow = value ? 'hidden' : 'auto';
    }
}" x-init="$watch('modalOpen', value => lockScroll(value))">

    @section('meta_title', 'Visual Archive — Reva Adhitya')

    <div class="max-w-[1440px] mx-auto px-6 md:px-12">
        
        {{-- 1. Editorial Header (Tanpa Border) --}}
        <header class="mb-32">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12">
                <div class="max-w-4xl">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="h-[1px] w-12 bg-orange-600"></div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.8em] text-white/40">Visual Archive</p>
                    </div>
                    <h1 class="text-[12vw] md:text-[9vw] font-black tracking-[calc(-0.06em)] leading-[0.8] text-white uppercase italic">
                        Fragments<span class="text-orange-600">.</span>
                    </h1>
                </div>
                <div class="max-w-xs md:text-right">
                    <p class="text-[11px] font-medium text-white/30 leading-relaxed uppercase tracking-[0.3em]">
                        Curated moments and digital experiments from 2024 — 2026.
                    </p>
                </div>
            </div>
        </header>

        {{-- 2. Clean Navigation --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-10 mb-20">
            <nav class="flex items-center gap-12">
                @foreach(['all', 'image', 'video'] as $t)
                    <button wire:click="setFilter('{{ $t }}')"
                        class="group relative py-2 text-[10px] font-black uppercase tracking-[0.5em] transition-all {{ $filter === $t ? 'text-white' : 'text-white/20 hover:text-white/60' }}">
                        {{ $t }}
                    </button>
                @endforeach
            </nav>

            <div class="flex items-center gap-8">
                <span class="text-[9px] font-bold uppercase tracking-[0.5em] text-white/10 italic">Filter by:</span>
                <div class="flex gap-6">
                    @foreach (['date', 'name'] as $field)
                        <button wire:click="sortBy('{{ $field }}')"
                            class="text-[10px] font-mono tracking-tighter transition-colors flex items-center gap-2 {{ $sortField === $field ? 'text-orange-500' : 'text-white/40 hover:text-white' }}">
                            {{ strtoupper($field) }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 3. Relaxed Grid (Clean, Grayscale 50%, Floating Style) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-12 md:gap-16">
            @foreach ($media as $index => $item)
                <div wire:key="media-{{ $index }}" wire:click="openMedia({{ json_encode($item) }})"
                    class="relative group cursor-pointer">

                    <div class="aspect-[4/5] overflow-hidden bg-white/[0.02] transition-all duration-700 group-hover:shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                        @if ($item['type'] === 'image')
                            <img src="{{ $item['url'] }}" alt="{{ $item['name'] }}"
                                class="h-full w-full object-cover transition-all duration-1000 grayscale-[50%] group-hover:grayscale-0 group-hover:scale-110"
                                loading="lazy">
                        @else
                            <div class="relative h-full w-full">
                                <video src="{{ $item['url'] }}" class="h-full w-full object-cover grayscale-[50%] group-hover:grayscale-0 transition-all duration-1000"></video>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-12 h-12 rounded-full border border-white/10 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <div class="w-0 h-0 border-y-[6px] border-y-transparent border-l-[10px] border-l-white ml-1"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Text Info (Outside/Below Grid for cleaner look) --}}
                    <div class="mt-6 flex justify-between items-start opacity-40 group-hover:opacity-100 transition-opacity">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] truncate max-w-[80%]">
                            {{ $item['name'] }}
                        </p>
                        <span class="font-mono text-[9px] text-orange-600">{{ sprintf('%02d', $index + 1) }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        @if (count($media) === 0)
            <div class="text-center py-60">
                <p class="text-white/10 text-xs font-bold uppercase tracking-[1.5em]">Empty_Archive</p>
            </div>
        @endif
    </div>

    {{-- 4. Minimalist Fullscreen Modal --}}
    @if ($selectedMedia)
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-6 md:p-20"
            x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-105"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-400">

            <div class="fixed inset-0 bg-[#070708]/95 backdrop-blur-2xl" wire:click="closeModal"></div>

            <div class="relative z-[110] w-full h-full flex flex-col items-center justify-center">
                @if ($selectedMedia['type'] === 'image')
                    <img src="{{ $selectedMedia['url'] }}" 
                        class="max-w-full max-h-[80vh] object-contain shadow-2xl border border-white/5">
                @else
                    <video src="{{ $selectedMedia['url'] }}" controls autoplay
                        class="max-w-full max-h-[80vh] shadow-2xl border border-white/5">
                    </video>
                @endif
                
                <div class="mt-12 text-center">
                    <h3 class="text-xs font-black uppercase tracking-[1em] text-white mb-2">{{ $selectedMedia['name'] }}</h3>
                    <button wire:click="closeModal" class="text-[9px] font-bold uppercase tracking-[0.5em] text-white/20 hover:text-orange-600 transition-colors">
                        [ Close ]
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>