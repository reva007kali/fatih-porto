<div x-data="{ open: false }" class="relative">
    
    {{-- Main Toggle Button - Ultra Minimalist Swiss Style --}}
    <button
        @click="open = !open"
        class="relative w-full flex items-center justify-between px-10 py-8 bg-white border-[3px] border-black transition-all duration-300 active:scale-[0.99] group"
    >
        {{-- Text & Icon --}}
        <div class="relative z-10 flex items-center gap-4">
            <h3 class="text-lg md:text-2xl font-black uppercase tracking-[-0.02em] text-black">
                Share Your Story
            </h3>
        </div>
        
        <div class="relative z-10 w-12 h-12 bg-black flex items-center justify-center transition-transform duration-500" 
             :class="open ? 'rotate-45' : ''">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 4v16m8-8H4" />
            </svg>
        </div>

        {{-- Hover Effect: Solid Offset Shadow --}}
        <div class="absolute inset-0 bg-black translate-x-0 translate-y-0 group-hover:translate-x-2 group-hover:translate-y-2 -z-10 transition-transform duration-300"></div>
    </button>

    {{-- The Form Container --}}
    <div
        x-show="open"
        x-collapse
        x-cloak
        class="mt-8 p-8 md:p-16 bg-white border-[3px] border-black shadow-[16px_16px_0px_0px_rgba(0,0,0,1)]"
    >
        @if (session()->has('message'))
            <div class="bg-black text-white px-8 py-6 mb-12 text-sm font-bold uppercase tracking-widest animate-in fade-in slide-in-from-top-4">
                <span class="mr-4">●</span> {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="submit" class="space-y-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                {{-- Name Input --}}
                <div class="space-y-4">
                    <label class="block text-xs font-black uppercase tracking-[0.4em] text-black">01. Full Name</label>
                    <input wire:model="name" type="text" placeholder="REQUIRED" 
                        class="w-full bg-transparent border-b-[3px] border-black rounded-none px-0 py-4 text-black placeholder-black/20 focus:outline-none focus:border-black transition-all text-xl font-bold uppercase">
                    @error('name') <span class="text-red-600 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
                </div>

                {{-- Position Input --}}
                <div class="space-y-4">
                    <label class="block text-xs font-black uppercase tracking-[0.4em] text-black">02. Position / Company</label>
                    <input wire:model="position" type="text" placeholder="REQUIRED"
                        class="w-full bg-transparent border-b-[3px] border-black rounded-none px-0 py-4 text-black placeholder-black/20 focus:outline-none focus:border-black transition-all text-xl font-bold uppercase">
                    @error('position') <span class="text-red-600 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Rating System - Solid Rectangles --}}
            <div class="space-y-6">
                <label class="block text-xs font-black uppercase tracking-[0.4em] text-black">03. Overall Rating</label>
                <div class="flex flex-wrap gap-4">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" wire:click="$set('rating', {{ $i }})" 
                            class="w-14 h-14 border-[3px] border-black flex items-center justify-center transition-all font-black text-xl
                            {{ $rating >= $i ? 'bg-black text-white scale-110' : 'bg-transparent text-black hover:bg-black/5' }}">
                            {{ $i }}
                        </button>
                    @endfor
                </div>
                @error('rating') <span class="text-red-600 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
            </div>

            {{-- Testimonial Content --}}
            <div class="space-y-4">
                <label class="block text-xs font-black uppercase tracking-[0.4em] text-black">04. Your Feedback</label>
                <textarea wire:model="content" rows="4" placeholder="DESCRIBE YOUR EXPERIENCE..."
                    class="w-full bg-white border-[3px] border-black rounded-none px-8 py-8 text-black placeholder-black/20 focus:outline-none focus:bg-black/5 transition-all text-lg font-medium leading-relaxed resize-none"></textarea>
                @error('content') <span class="text-red-600 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
            </div>

            {{-- Custom File Upload - Stark & Bold --}}
            <div class="space-y-4">
                <label class="block text-xs font-black uppercase tracking-[0.4em] text-black">05. Profile Photo (Optional)</label>
                <label class="relative flex flex-col items-center justify-center w-full h-48 border-[3px] border-dashed border-black bg-white cursor-pointer hover:bg-black/5 transition-all">
                    @if ($avatar)
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-black text-white flex items-center justify-center font-black mb-2">OK</div>
                            <span class="text-[10px] font-black uppercase tracking-widest">Image Loaded</span>
                        </div>
                    @else
                        <div class="text-center">
                            <span class="text-sm font-black uppercase tracking-[0.3em]">Click to Upload +</span>
                        </div>
                    @endif
                    <input wire:model="avatar" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                </label>
                @error('avatar') <span class="text-red-600 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
            </div>

            {{-- Submit Button - Full Black --}}
            <button type="submit" 
                class="w-full relative py-8 bg-black text-white font-black uppercase tracking-[0.5em] text-sm transition-all duration-300 hover:invert active:scale-[0.98]">
                Submit Testimonial
            </button>
            
            <p class="text-center text-[10px] text-black font-black uppercase tracking-[0.3em]">
                Verified Submission Portal / © 2026
            </p>
        </form>
    </div>
</div>