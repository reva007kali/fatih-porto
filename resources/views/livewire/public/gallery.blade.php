<div class="bg-[#0b0b0d] min-h-screen text-white pt-32 pb-24" x-data="{
    modalOpen: @entangle('selectedMedia'),
    lockScroll(value) {
        if (value) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = 'auto';
        }
    }
}" x-init="$watch('modalOpen', value => lockScroll(value))">

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
                    All
                </button>
                <button wire:click="setFilter('image')"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all {{ $filter === 'image' ? 'bg-orange-600 text-white shadow-lg shadow-orange-600/20' : 'text-white/40 hover:text-white' }}">
                    Images
                </button>
                <button wire:click="setFilter('video')"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-all {{ $filter === 'video' ? 'bg-orange-600 text-white shadow-lg shadow-orange-600/20' : 'text-white/40 hover:text-white' }}">
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
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-5">
                        <p class="text-white text-[10px] font-bold truncate uppercase tracking-widest">
                            {{ $item['name'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        @if (count($media) === 0)
            <div class="text-center py-32 border border-dashed border-white/10 rounded-3xl bg-white/[0.02]">
                <p class="text-white/30 text-xl font-medium">No items found.</p>
            </div>
        @endif
    </div>

    {{-- Improved Fullscreen Modal --}}
    @if ($selectedMedia)
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-6 md:p-12"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            {{-- Backdrop --}}
            <div class="fixed inset-0 bg-black/95 backdrop-blur-2xl" wire:click="closeModal"></div>

            {{-- Close Button --}}
            <button wire:click="closeModal"
                class="fixed top-6 right-6 text-white/50 hover:text-white transition-all z-[120] p-2 hover:rotate-90 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:w-10 md:h-10" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Media Content Wrapper --}}
            <div class="relative z-[110] max-w-full max-h-[80vh] flex items-center justify-center"
                x-on:click.away="$wire.closeModal()">

                @if ($selectedMedia['type'] === 'image')
                    <img src="{{ $selectedMedia['url'] }}" alt="{{ $selectedMedia['name'] }}"
                        class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-[0_0_50px_rgba(0,0,0,0.5)] border border-white/10">
                @else
                    <video src="{{ $selectedMedia['url'] }}" controls autoplay
                        class="max-w-full max-h-[80vh] rounded-lg shadow-[0_0_50px_rgba(0,0,0,0.5)] border border-white/10">
                    </video>
                @endif
            </div>
        </div>
    @endif

    <style>
        /* Prevent layout shift when scrollbar disappears */
        body.overflow-hidden {
            padding-right: 15px;
        }

        @media (max-width: 768px) {
            body.overflow-hidden {
                padding-right: 0;
            }
        }
    </style>

</div>
