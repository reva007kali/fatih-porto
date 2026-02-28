<div class="bg-[#0b0b0d] min-h-screen text-white pt-32 pb-24" x-data="{ modalOpen: @entangle('selectedMedia') }">

    @section('meta_title', 'Visual Gallery | Reva Adhitya')
    @section('meta_description', 'A curated selection of moments, designs, and visual experiments by Reva Adhitya.')

    <div class="max-w-7xl mx-auto px-6 md:px-12">
        {{-- Header --}}
        <div class="text-center max-w-4xl mx-auto mb-16 reveal-text">
            <div
                class="inline-flex items-center gap-3 mb-6 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                </span>
                <p class="text-orange-500 font-black tracking-[0.4em] uppercase text-[10px]">Gallery</p>
            </div>

            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white mb-8 leading-[0.9]">
                Visual <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Collection.</span>
            </h1>
        </div>

        {{-- Toolbar: Filters & Sorting --}}
        <div
            class="flex flex-col md:flex-row justify-between items-center gap-8 mb-12 p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">

            {{-- Type Filters --}}
            <div class="flex items-center gap-2 p-1 bg-black/40 rounded-xl border border-white/5">
                <button wire:click="setFilter('all')"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all {{ $filter === 'all' ? 'bg-orange-600 text-white shadow-lg shadow-orange-600/20' : 'text-white/40 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    All
                </button>
                <button wire:click="setFilter('image')"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all {{ $filter === 'image' ? 'bg-orange-600 text-white shadow-lg shadow-orange-600/20' : 'text-white/40 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Images
                </button>
                <button wire:click="setFilter('video')"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all {{ $filter === 'video' ? 'bg-orange-600 text-white shadow-lg shadow-orange-600/20' : 'text-white/40 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    Videos
                </button>
            </div>

            {{-- Sort Controls --}}
            <div class="flex items-center gap-6">
                <span class="text-white/30 text-[10px] font-black uppercase tracking-[0.2em]">Sort By</span>
                <div class="flex gap-4">
                    @foreach (['date', 'name', 'size'] as $field)
                        <button wire:click="sortBy('{{ $field }}')"
                            class="text-[11px] font-black uppercase tracking-widest transition-colors flex items-center gap-1 {{ $sortField === $field ? 'text-orange-500' : 'text-white/50 hover:text-white' }}">
                            {{ $field }}
                            @if ($sortField === $field)
                                <span>{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Gallery Grid --}}
        <div class="flex flex-wrap gap-4 justify-center">
            @foreach ($media as $index => $item)
                <div wire:key="media-{{ $index }}" wire:click="openMedia({{ json_encode($item) }})"
                    class="relative group h-48 md:h-64 lg:h-[350px] flex-shrink-0 rounded-xl overflow-hidden bg-[#161618] border border-white/5 hover:border-orange-500/50 transition-all duration-500 cursor-pointer">

                    @if ($item['type'] === 'image')
                        <img src="{{ $item['url'] }}" alt="{{ $item['name'] }}"
                            class="h-full w-auto object-cover transition-transform duration-700 group-hover:scale-110"
                            loading="lazy">
                    @else
                        <div class="relative h-full">
                            <video src="{{ $item['url'] }}" class="h-full w-auto object-cover"></video>
                            <div
                                class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/40 transition-colors">
                                <div class="w-12 h-12 rounded-full bg-orange-600 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-white"
                                        viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-5">
                        <p class="text-white text-xs font-bold truncate">{{ $item['name'] }}</p>
                        <p class="text-white/50 text-[10px] uppercase tracking-tighter">
                            {{ round($item['size'] / 1024 / 1024, 2) }} MB</p>
                    </div>
                </div>
            @endforeach
        </div>

        @if (count($media) === 0)
            <div class="text-center py-32 border border-dashed border-white/10 rounded-3xl bg-white/[0.02]">
                <div class="mb-4 opacity-20 flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-white/30 text-xl font-medium">No {{ $filter !== 'all' ? $filter . 's' : 'media' }}
                    found.
                </p>
            </div>
        @endif
    </div>

    {{-- Fullscreen Scrollable Modal --}}
    @if ($selectedMedia)
        <div class="fixed inset-0 z-[100] overflow-y-auto" role="dialog" aria-modal="true">
            {{-- Backdrop (Fixed) --}}
            <div class="fixed inset-0 bg-black/95 backdrop-blur-xl transition-opacity" wire:click="closeModal"></div>

            {{-- Fixed Close Button (Always visible) --}}
            <button wire:click="closeModal"
                class="fixed top-6 right-6 md:top-10 md:right-10 text-white/50 hover:text-white transition-colors z-[120] bg-black/20 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:w-10 md:h-10" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Scrolling Content Wrapper --}}
            <div class="relative min-h-screen flex items-center justify-center p-4 md:p-12 pointer-events-none">

                {{-- Content Card (Pointer events restored here) --}}
                <div class="relative w-full max-w-5xl flex flex-col items-center pointer-events-auto"
                    x-on:click.away="$wire.closeModal()">

                    {{-- Media Container --}}
                    <div class="w-full flex justify-center bg-black/40 rounded-2xl overflow-hidden shadow-2xl">
                        @if ($selectedMedia['type'] === 'image')
                            <img src="{{ $selectedMedia['url'] }}"
                                class="w-auto h-auto max-w-full block shadow-2xl shadow-black transition-all">
                        @else
                            <video src="{{ $selectedMedia['url'] }}" controls autoplay
                                class="w-full max-h-[85vh] shadow-2xl shadow-black"></video>
                        @endif
                    </div>

                    {{-- Metadata Footer --}}
                    <div class="mt-8 text-center pb-12">
                        <h3 class="text-white text-xl md:text-2xl font-black tracking-tight uppercase italic mb-2">
                            {{ $selectedMedia['name'] }}
                        </h3>
                        <div
                            class="flex flex-wrap justify-center items-center gap-4 text-white/40 text-[10px] font-black uppercase tracking-[0.2em]">
                            <span>{{ date('F d, Y', $selectedMedia['date']) }}</span>
                            <span class="w-1 h-1 rounded-full bg-orange-500"></span>
                            <span>{{ round($selectedMedia['size'] / 1024 / 1024, 2) }} MB</span>
                            <span class="w-1 h-1 rounded-full bg-orange-500"></span>
                            <span>{{ strtoupper($selectedMedia['type']) }}</span>
                        </div>

                        <div class="mt-8">
                            <a href="{{ $selectedMedia['url'] }}" download
                                class="inline-flex items-center gap-3 px-8 py-4 bg-orange-600 hover:bg-orange-500 text-white text-[11px] font-black uppercase tracking-widest rounded-full transition-all hover:scale-105 active:scale-95 shadow-xl shadow-orange-600/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download Original
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
