<div class="relative w-full h-screen bg-black overflow-hidden">
    {{-- 3D Canvas --}}
    <div id="showcase-canvas" class="absolute inset-0 z-0"></div>

    {{-- Overlay UI --}}
    <div class="absolute inset-0 z-10 pointer-events-none">

        {{-- Header --}}
        <div class="absolute top-0 left-0 w-full p-8 flex justify-between items-start pointer-events-auto">
            <a href="{{ route('home') }}"
                class="group flex items-center gap-3 text-white/50 hover:text-white transition-colors">
                <div
                    class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
                <span class="text-xs font-black uppercase tracking-[0.2em]">Back to Home</span>
            </a>

            <div class="text-right">
                <h1 class="text-4xl md:text-6xl font-black tracking-tighter text-white mb-2">
                    3D <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">SKILLS</span>
                </h1>
                <p class="text-xs font-bold uppercase tracking-[0.4em] text-white/30">Interactive Showcase</p>
            </div>
        </div>

        {{-- Instructions --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-center pointer-events-auto">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-white/20 animate-pulse">
                Click & Drag to Rotate • Scroll to Zoom • Click Objects
            </p>
        </div>

        {{-- Tech Stack List (Overlay) --}}
        <div class="absolute bottom-10 right-8 hidden md:block text-right pointer-events-auto">
            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-orange-500 mb-4">Tech Stack</h3>
            <ul class="space-y-2 text-xs font-bold text-white/40">
                <li class="hover:text-white transition-colors">Three.js R160</li>
                <li class="hover:text-white transition-colors">React Three Fiber</li>
                <li class="hover:text-white transition-colors">WebGL / GLSL</li>
                <li class="hover:text-white transition-colors">Blender 4.0</li>
                <li class="hover:text-white transition-colors">GSAP Animations</li>
            </ul>
        </div>

    </div>
</div>
