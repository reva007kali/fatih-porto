<div class="bg-[#0b0b0d] min-h-screen text-white pt-32 pb-24">
    @section('meta_title', '3D Gallery | Reva Adhitya')
    @section('meta_description', 'Interactive 3D models and experiments.')
    @section('meta_keywords', '3D, Three.js, WebGL, Models, Interactive')

    <div class="max-w-7xl mx-auto px-6 md:px-12">
        {{-- Header --}}
        <div class="text-center max-w-4xl mx-auto mb-24 reveal-text">
            <div class="inline-flex items-center gap-3 mb-6 px-5 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-500 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <p class="text-orange-500 font-black tracking-[0.4em] uppercase text-[10px]">WebGL Experiments</p>
            </div>
            
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white mb-8 leading-[0.9]">
                3D <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Dimension.</span>
            </h1>
            
            <p class="text-white/40 text-xl md:text-2xl leading-relaxed max-w-2xl mx-auto">
                Interactive objects and spatial explorations.
            </p>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($models as $model)
                <a href="{{ route('three-d.show', $model->slug) }}" class="group relative block bg-[#161618] rounded-2xl overflow-hidden border border-white/5 hover:border-blue-500/50 transition-all duration-500 hover:-translate-y-2">
                    <div class="aspect-square w-full bg-gradient-to-br from-gray-800 to-black flex items-center justify-center relative overflow-hidden">
                        @if($model->thumbnail_path)
                            <img src="{{ Storage::url($model->thumbnail_path) }}" alt="{{ $model->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="text-6xl grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500">
                                🧊
                            </div>
                        @endif
                        
                        {{-- Overlay --}}
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="px-6 py-2 bg-white/10 backdrop-blur-md rounded-full text-white text-sm font-bold border border-white/20">
                                View 3D Model
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-blue-400 transition-colors">{{ $model->title }}</h3>
                        <p class="text-white/40 text-sm line-clamp-2">{{ $model->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        @if($models->isEmpty())
            <div class="text-center py-20 border border-dashed border-white/10 rounded-3xl">
                <p class="text-white/30 text-xl">No 3D models found.</p>
            </div>
        @endif
    </div>
</div>
