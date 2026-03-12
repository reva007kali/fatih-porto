<div class="bg-[#070708] min-h-screen text-[#e5e5e5] pt-40 pb-32">
    @section('meta_title', '3D Archive — Reva Adhitya')

    <div class="max-w-[1440px] mx-auto px-6 md:px-12">
        {{-- 1. Arsitektural Header --}}
        <header class="mb-32">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12">
                <div class="max-w-4xl">
                    <div class="flex items-center gap-4 mb-10">
                        <span class="font-mono text-[10px] text-orange-600 tracking-tighter">// SPATIAL_EXPLORATION</span>
                        <div class="h-[1px] w-12 bg-white/10"></div>
                    </div>
                    <h1 class="text-[12vw] md:text-[9vw] font-black tracking-[calc(-0.06em)] leading-[0.8] text-white uppercase italic">
                        Dimension<span class="text-orange-600">.</span>
                    </h1>
                </div>
                <div class="max-w-xs md:text-right">
                    <p class="text-[11px] font-medium text-white/30 leading-relaxed uppercase tracking-[0.4em]">
                        Interactive WebGL environments and procedural 3D artifacts.
                    </p>
                </div>
            </div>
        </header>

        {{-- 2. Technical Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 md:gap-24">
            @foreach($models as $index => $model)
                <a href="{{ route('three-d.show', $model->slug) }}" 
                   class="group relative block transition-all duration-700">
                    
                    {{-- Thumbnail Wrapper --}}
                    <div class="relative aspect-square w-full bg-[#0a0a0b] overflow-hidden">
                        {{-- Grayscale Thumbnail --}}
                        @if($model->thumbnail_path)
                            <img src="{{ Storage::url($model->thumbnail_path) }}" 
                                 alt="{{ $model->title }}" 
                                 class="w-full h-full object-cover transition-all duration-[1.5s] grayscale-[50%] group-hover:grayscale-0 group-hover:scale-110 group-hover:rotate-1">
                        @else
                            <div class="w-full h-full flex items-center justify-center grayscale-[50%] group-hover:grayscale-0 transition-all duration-700">
                                <span class="text-6xl filter blur-[2px] group-hover:blur-0 transition-all">🧊</span>
                            </div>
                        @endif

                        {{-- Technical Corner Labels --}}
                        <div class="absolute top-0 left-0 p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <span class="font-mono text-[9px] text-orange-600 uppercase tracking-tighter">Rendered_Eevee</span>
                        </div>
                        
                        {{-- Center Action --}}
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                            <div class="px-8 py-3 bg-white text-black text-[10px] font-black uppercase tracking-[0.3em]">
                                Enter Space
                            </div>
                        </div>
                    </div>

                    {{-- Info Section (Editorial Style) --}}
                    <div class="mt-8 border-t border-white/5 pt-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xs font-black uppercase tracking-[0.4em] text-white group-hover:text-orange-600 transition-colors">
                                {{ $model->title }}
                            </h3>
                            <span class="font-mono text-[10px] text-white/20 italic">
                                #{{ sprintf('%03d', $index + 1) }}
                            </span>
                        </div>
                        <p class="text-[11px] font-light text-white/40 leading-relaxed tracking-wide line-clamp-2 max-w-[90%] uppercase">
                            {{ $model->description }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- 3. Empty State --}}
        @if($models->isEmpty())
            <div class="text-center py-40 border-t border-white/5 mt-20">
                <p class="text-white/10 text-[10px] font-bold uppercase tracking-[1.5em]">No_Entities_Found</p>
            </div>
        @endif
    </div>
    <style>
        /* Halus-kan pergerakan hover pada elemen berat seperti 3D Thumbnails */
        .group:hover img {
            will-change: transform, filter;
        }
    </style>
</div>

